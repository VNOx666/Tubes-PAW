@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    @if(auth()->user()->role === 'seller')
        @include('pages.seller.dashboard')
    @else
        @include('pages.home')
    @endif
@endsection
s
