<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Order;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // list chat user (buyer/seller)
    public function index(Request $request)
    {
        $user = $request->user();

        $conversations = Conversation::query()
            ->where('buyer_id', $user->id)
            ->orWhere('seller_id', $user->id)
            ->with(['order', 'buyer', 'seller'])
            ->latest('updated_at')
            ->get();

        return view('pages.chat.index', compact('conversations'));
    }

    // buka chat berdasarkan order (lebih gampang dipakai)
    public function showByOrder(Request $request, Order $order)
    {
        $user = $request->user();

        if ($order->user_id !== $user->id) {
            // seller boleh akses kalau dia memang pemilik item pada order tsb
            $isSeller = $order->items()->where('seller_id', $user->id)->exists();
            if (!$isSeller) abort(403);
        }

        // ambil seller pertama (simple: order bisa multi seller, nanti kita tingkatkan)
        $sellerId = $order->items()->value('seller_id');

        $conversation = Conversation::firstOrCreate([
            'order_id' => $order->id,
            'buyer_id' => $order->user_id,
            'seller_id' => $sellerId,
        ]);

        return redirect()->route('chat.show', $conversation);
    }

    public function show(Request $request, Conversation $conversation)
    {
        $this->authorizeParticipant($request, $conversation);

        $conversation->load(['order', 'buyer', 'seller', 'messages.sender']);

        // mark read: semua message dari lawan yang belum read
        Message::where('conversation_id', $conversation->id)
            ->whereNull('read_at')
            ->where('sender_id', '!=', $request->user()->id)
            ->update(['read_at' => now()]);

        return view('pages.chat.show', compact('conversation'));
    }

    public function send(Request $request, Conversation $conversation)
    {
        $this->authorizeParticipant($request, $conversation);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        // supaya urutan chat naik
        $conversation->touch();

        return back();
    }

    private function authorizeParticipant(Request $request, Conversation $conversation): void
    {
        $uid = $request->user()->id;

        if ($conversation->buyer_id !== $uid && $conversation->seller_id !== $uid) {
            abort(403, 'Akses chat ditolak.');
        }
    }
}
