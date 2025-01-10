@extends('layouts.app')
@section('title', $receiver->name)

@section('content')
    <div class="chat-container">
        <h1 class="chat-header">{{ $receiver->name }}</h1>

        <div class="chat-box" id="chat-box">
            @if ($messages->isEmpty())
                <div class="chat-message system-message">
                    <p>No messages yet. Start the conversation!</p>
                </div>
            @else
                @foreach ($messages as $message)
                    <div class="chat-message {{ $message->sender_id === Auth::id() ? 'chat-sent' : 'chat-received' }}">
                        <div class="chat-bubble">
                            <p>{{ $message->message }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <form method="POST" action="{{ route('chat.send') }}" class="chat-form">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
            <input type="text" name="message" placeholder="Type your message..." required class="chat-input">
            <button type="submit" class="chat-send-button"> > </button>
        </form>
    </div>
@endsection
