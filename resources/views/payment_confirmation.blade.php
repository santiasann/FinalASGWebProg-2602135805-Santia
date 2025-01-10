@extends('layouts.app')
@section('title', __('crud.payconfirm'))

@section('content')
    <div class="container"style="padding-top: 80px;padding-bottom: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="text-align:center;">
                <h1 style="text-align:center;">{{ __('crud.payconfirm') }}</h1>
                    @if(session('message'))
                        <p>{{ session('message') }}</p>
                    @endif

                    <form method="POST" action="{{ route('payment.confirmation.submit') }}" style="text-align:center;">
                        @csrf
                        <button type="submit" name="action" value="yes" class="btn btn-primary">{{ __('crud.yes') }}</button>
                        <button type="submit" class="btn btn-primary"name="action" value="no">{{ __('crud.no') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
