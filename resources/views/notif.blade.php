@extends('layouts.app')
@section('title', 'notifications')

@section('content')
    <div class="container" style="padding-top: 80px;padding-bottom: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <h2 class="mb-3">@lang('notifications.friend_requests')</h2>
                @forelse ($friendRequests as $request)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">{{ $request->user->name }}</h5>
                                <p class="card-text text-muted">@lang('notifications.sent_request')</p>
                            </div>
                            <form action="{{ route('wishlist.add') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="wishlist_user_id" value="{{ $request->user->id }}">
                                <button type="submit" class="thumb-button">
                                    <i class="fas fa-thumbs-up"></i> 👍 @lang('notifications.accept')
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <p>@lang('notifications.no_friend_requests')</p>
                    </div>
                @endforelse

                <h2 class="mb-3">@lang('notifications.unread_messages')</h2>
                @forelse ($unreadMessages as $message)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">{{ $message->sender->name }}</h5>
                                <p class="card-text">{{ $message->message }}</p>
                            </div>
                            <a href="{{ route('chat.detail', ['receiverId' => $message->sender->id]) }}" class="btn btn-primary">@lang('notifications.view')</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <p>@lang('notifications.no_unread_messages')</p>
                    </div>
                @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection