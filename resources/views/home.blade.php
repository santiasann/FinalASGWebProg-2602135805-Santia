@extends('layouts.app')
@section('title', __('crud.home'))

@section('content')
<div class="container" style="padding-top: 80px;padding-bottom: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('crud.home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <form method="GET" action="{{ route('home') }}"> 
                    <div class="form-group">
                        <label for="gender">{{ __('crud.gender') }}:</label>
                        <select name="gender" class="form-control">
                            <option value="">{{ __('crud.select') }}</option>
                            <option value="male">{{ __('crud.male') }}</option>
                            <option value="female">{{ __('crud.female') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="job">{{ __('crud.job') }}:</label>
                        <input type="text" name="job" class="form-control" placeholder="Search by Job">
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('crud.search') }}</button>
                </form>

                <div class="results">
                    @foreach ($users as $user)
                        <div class="user">
                            {{ $user->name }} - {{ $user->gender }} - {{ $user->job }}
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    @forelse ($users as $user)
                        <div class="col-md-4 mb-3">
                            <div class="card text-center shadow-sm">
                                <div class="card-body">
                                    @if ($user->profile_picture)
                                        <img src="{{ asset('uploads/profile_pictures/' . $user->profile_picture) }}" 
                                            alt="@lang('home.profile_picture')" class="rounded-circle mb-3" width="100" height="100">
                                    @else
                                        <img src="{{ asset('default_profile_picture.png') }}" 
                                            alt="@lang('home.default_profile_picture')" class="rounded-circle mb-3" width="100" height="100">
                                    @endif
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="text-muted mb-1">{{ $user->profession }}</p>
                                    <p class="text-muted small">
                                        {{ implode(', ', json_decode($user->field_of_work, true) ?? [__('home.no_fields')]) }}
                                    </p>
                                    <form action="{{ route('wishlist.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="wishlist_user_id" value="{{ $user->id }}">
                                        @if ($user->isMutual)
                                            <a href="{{ route('chat.detail', ['receiverId' => $user->id]) }}" 
                                            class="btn btn-primary">@lang('home.chat_button')</a>
                                        @elseif ($user->isFollowing)
                                            <button type="button" class="btn btn-secondary" disabled>@lang('home.following_button')</button>
                                        @else
                                            <button type="submit" class="btn btn-outline-primary">@lang('home.thumbs_up') </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">@lang('home.no_users_found')</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
