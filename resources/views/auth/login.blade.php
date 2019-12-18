@extends('auth.layout')

@section('content')
    <form class="w-100" method="post" action="{{ route('login') }}">
        @csrf

        <input-component type="email"  name="email"  field="email" placeholder="{{ __('resources.user.email') }}" value="{{ old('email') }}" error="{{ $errors->first('email') ?? null }}"></input-component>

        <input-component type="password" name="password"  field="password" placeholder="Password" error="{{ $errors->first('password') ?? null }}"></input-component>

        <div class="md:flex md:items-center mb-6">
            <label class="block text-gray-500 font-bold">
                <input class="mr-1 leading-tight" type="checkbox" name="remember">
                <span class="text-sm">{{ __('auth.rememberMe') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <button class="button button-blue-outline" type="submit">{{ __('auth.signIn') }}</button>
            <a class="link-gray" href="{{ route('password.request') }}">{{ __('passwords.forgot') }}</a>
        </div>
    </form>
@endsection
