@extends('layouts.app')
@section('title', $user->name . ' Profile') 

@section('content')
    <div class="container" style="padding-top: 80px;padding-bottom: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Profile') }}</div>

                    <div class="card-body">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="img-fluid rounded-circle">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p>Gender: {{ $user->gender }}</p>
                        <p>Fields of Work: {{ implode(', ', $user->fields_of_work) }}</p>
                        
                        @if (auth()->check())
                            @if (auth()->user()->wishlist->contains($user) && $user->wishlist->contains(auth()->user()))
                                <a href="{{ route('chat', $user) }}" class="btn btn-primary">Chat</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection