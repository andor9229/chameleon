@php
    $pageTitle = 'Conferma email';
@endphp

@extends('layouts.app')

@section('content')
    <p class="font-bold">{{ __('Verify Your Email Address') }}</p>

    @if (session('resent'))
        <div class="w-1/2 mx-auto my-5 flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <p>{{ __('A fresh verification link has been sent to your email address.') }}</p>
        </div>
    @endif

    <p class="my-5">{{ __('Before proceeding, please check your email for a verification link.') }}</p>

    <div class="flex items-center">
        <p>{{ __('If you did not receive the email') }},&nbsp;</p>
        <form class="" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="link-gray">{{ __('click here to request another') }}</button>
        </form>
    </div>
@endsection
