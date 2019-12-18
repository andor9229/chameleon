<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    </head>
    <body class="bg-gray-300">
        <div id="app">
            <account-component :showaccountmodal="showaccountmodal" @close="showAccountModal(false)"></account-component>
            @include('layouts.nav')

            @if (session('status'))
                <div class="w-1/4 mx-auto mt-2 -mb-8 flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            @if (session('notification'))
                <notification-component message=" {{ session('notification') }}" type="success"></notification-component>
            @endif

            @if (session('error'))
                <notification-component message=" {{ session('error') }}" type="error"></notification-component>
            @endif

            @yield('breadcrumbs')

            <main class="container mx-auto p-10 text-gray-800">
                <div class="flex my-4 items-center">
                    @yield('toolbar')
                </div>
                    @yield('content')
            </main>
        </div>
        @auth
        <script>
            window.Laravel = {!! json_encode(([
               'apiToken' => auth()->user()->api_token ?? null,
           ])) !!};
        </script>
        @endauth


        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        @yield('script')

    </body>

</html>
