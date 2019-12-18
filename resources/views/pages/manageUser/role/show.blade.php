@extends('layouts.app')

@section('content')
    <div class="flex mb-10 justify-center">
       <card-component class="w-full">
           <h3 slot="header">
               Ruolo: {{ $role->name }}
           </h3>
           <div slot="body">
               <p>Nome: {{ $role->name }}</p>
           </div>
       </card-component>
    </div>
@endsection
