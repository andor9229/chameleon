@extends('layouts.app')

@section('content')
    <div class="flex mb-10 justify-center">
       <card-component class="w-full">
           <h3 slot="header">
               Utente: {{ $user->name }}
           </h3>
           <div slot="body">
               <p>Nome: {{ $user->name }}</p>
               <p>Email: {{ $user->email }}</p>
           </div>
       </card-component>
    </div>
@endsection
