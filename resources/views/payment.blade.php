@extends('layouts.app')
@section('title', __('crud.payment'))

@section('content')
    <div class="container"style="padding-top: 80px;padding-bottom: 80px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="payment-container">
                      <h1 style="text-align:center;">{{ __('crud.payment') }}</h1>

                      @if (session('message'))
                          <p class="message">{{ session('message') }}</p>
                      @endif

                      <form method="POST" action="{{ route('payment.submit') }}" style="text-align:center;">
                        @csrf

                        @if ($errors->any())
                            <div class="error">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <label for="amount">{{__('crud.amount')}}</label>
                        <input id="amount" type="number" name="amount" placeholder="Enter amount" required>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4" style="padding-top: 20px;">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('crud.submit') }}
                                </button>
                            </div>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
