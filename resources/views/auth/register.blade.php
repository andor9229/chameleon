@extends('auth.layout')

@section('content')
    <form class="w-full" method="post" action="{{ route('register') }}">
        @csrf
        <input-component field="name" placeholder="{{ __('resources.user.name') }}" value="{{ old('name') }}" error="{{ $errors->first('name') ?? null }}"></input-component>

        <input-component type="email" field="email" placeholder="{{ __('resources.user.email') }}" value="{{ old('email') }}" error="{{ $errors->first('email') ?? null }}"></input-component>

        <input-component type="password" field="password" placeholder="Password" error="{{ $errors->first('password') ?? null }}"></input-component>

        <input-component type="password" field="password_confirmation" placeholder="{{ __('passwords.confirm') }}"></input-component>

        <div class="flex items-center justify-between">
            <button class="button button-blue-outline" type="submit">{{ __('auth.register') }}</button>
        </div>
    </form>
@endsection
