<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body>
<div id="app" class="md:flex min-h-screen">
    <div class="flex flex-col md:w-1/2 h-screen bg-gray-200 items-center justify-center">
        @if (session('status'))
            <div class="bg-white border-t-4 border-blue-500 rounded-lg text-blue-500 px-4 py-3 shadow-lg login-box mb-5" role="alert" style="width: 400px">
                <div class="flex items-center">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                        <p class="font-bold">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg p-10" style="width: 500px">
            <div class="text-center mb-5 fle">
                <img src="{{ asset('/img/logo.png') }}" alt="logo" width="200" class="mx-auto mb-5"/>
                <h1 class="font-bold uppercase ">{{ env('APP_NAME') }}</h1>
            </div>

            @yield('content')
        </div>
    </div>
    <div class="md:flex md:w-1/2 h-screen bg-blue-800">
        <img src="https://cdn.lynda.com/static/landing/images/hero/becomeawebdeveloper_LP_1200x630-1521738827875.jpg" class="object-cover w-full" alt="" />
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
