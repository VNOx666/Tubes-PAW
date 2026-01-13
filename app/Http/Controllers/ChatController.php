<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
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

    // START CHAT TANPA ORDER (dari halaman product / profil seller)
    public function start(Request $request, User $seller)
    {
        $buyer = $request->user();

        if ($buyer->role !== 'buyer') abort(403);
        if ($seller->role !== 'seller') abort(404);

        // IMPORTANT: thread_key wajib diisi (karena kolom thread_key NOT NULL)
        $threadKey = "pre:{$buyer->id}:{$seller->id}";

        $conversation = Conversation::firstOrCreate(
            ['thread_key' => $threadKey],
            [
                'order_id' => null,
                'buyer_id' => $buyer->id,
                'seller_id' => $seller->id,
            ]
        );

        return redirect()->route('chat.show', $conversation);
    }

    // CHAT BERDASARKAN ORDER (existing kamu)
    public function showByOrder(Request $request, Order $order)
    {
        $user = $request->user();

        // buyer owner order boleh
        if ($order->user_id !== $user->id) {
            // seller yang ada di order items boleh
            $isSeller = $order->items()->where('seller_id', $user->id)->exists();
            if (!$isSeller) abort(403);
        }

        $sellerId = $order->items()->value('seller_id');

        $threadKey = "order:{$order->id}:{$order->user_id}:{$sellerId}";

        $conversation = Conversation::firstOrCreate(
            ['thread_key' => $threadKey],
            [
                'order_id' => $order->id,
                'buyer_id' => $order->user_id,
                'seller_id' => $sellerId,
            ]
        );

        return redirect()->route('chat.show', $conversation);
    }

    public function show(Request $request, Conversation $conversation)
    {
        $this->authorizeParticipant($request, $conversation);

        $conversation->load(['order', 'buyer', 'seller', 'messages.sender']);

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
