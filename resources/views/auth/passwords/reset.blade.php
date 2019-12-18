@extends('auth.layout')

@section('content')
    <form class="w-100" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <input-component type="email" field="email" placeholder="{{ __('resources.user.email') }}" value="{{ $email ?? old('email') }}" error="{{ $errors->first('email') ?? null }}"></input-component>

        <input-component type="password" field="password" placeholder="Password" error="{{ $errors->first('password') ?? null }}"></input-component>

        <input-component type="password" field="password_confirmation" placeholder="{{ __('passwords.confirm') }}"></input-component>


        <div class="flex items-center justify-between">
            <button class="button button-blue-outline" type="submit">{{ __('Reset Password') }}</button>
        </div>
    </form>
@endsection
