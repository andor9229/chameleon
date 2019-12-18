@extends('auth.layout')

@section('content')
    <form class="w-100" method="post" action="{{ route('password.email') }}">
        @csrf

        <input-component type="email"  name="email"  field="email" placeholder="Email" value="{{ old('email') }}" error="{{ $errors->first('email') ?? null }}"></input-component>

        <div class="flex items-center justify-between">
            <button class="button button-blue-outline" type="submit">{{ __('passwords.resetLink')  }}</button>
        </div>
    </form>
@endsection
