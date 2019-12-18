@extends('layouts.app')

@section('content')
    <div class="flex mb-10 justify-center">
       <card-component class="w-full">
           <div slot="header">
               @if($type === 'create')
                   <h3 slot="header">Crea Nuovo Utente</h3>
               @else
                   <h3 slot="header">Modifica Utente</h3>
               @endif
           </div>

           <div slot="body">
               <form class="w-4/5" method="POST" action="{{ $type === 'create' ? route('manageUser.user.store') : route('manageUser.user.update', [ 'user' => $user->id ]) }}" >
                   @csrf
                   @if($type === 'update')
                       @method('patch')
                   @endif
                   <div class="md:flex md:items-center mb-6">
                       <div class="md:w-1/3">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                                Nome
                           </label>
                       </div>
                       <div class="md:w-2/3">
                           <input
                               type="text"
                               name="name"
                               class="bg-gray-200 appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200'}}" id="inline-full-name"
                               value="{{ $type === 'update' ? $user->name : '' }}"
                           >
                           @error('name')
                           <p class="text-red-500 text-xs italic">{{ $message }}</p>
                           @enderror
                       </div>
                   </div>
                   <div class="md:flex md:items-center mb-6">
                       <div class="md:w-1/3">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                               Email
                           </label>
                       </div>
                       <div class="md:w-2/3">
                           <input
                               type="text"
                               name="email"
                               class="bg-gray-200 appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200'}}"
                               id="inline-full-name"
                               value="{{ $type === 'update' ? $user->email : ''}}"
                           >
                           @error('email')
                               <p class="text-red-500 text-xs italic">{{ $message }}</p>
                           @enderror
                       </div>
                   </div>
                   <div class="md:flex md:items-center mb-6">
                       <div class="md:w-1/3">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                               Seleziona l'organizzazione
                           </label>
                       </div>
                       <div class="md:w-2/3">
                           <select
                               class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               id="organization"
                               name="organization[]"
                               multiple
                           >
                               <option value="Seleziona l'organizzazione">Seleziona l'organizzazione</option>
                               @foreach($organizations as $organization)
                                  <option value="{{ $organization->id }}" {{ $type === 'update' &&  in_array($organization->id, $user->organizations()->pluck('organizations.id')->toArray()) ? "selected" : ''}}>{{ $organization->name }}</option>
                               @endforeach
                           </select>
                           <div class="text-right">
                               <a href="{{ route('manageUser.organization.create') }}" class="text-blue-500 hover:text-blue-700">Crea nuova organizzazione</a>
                           </div>

                       </div>
                   </div>
                   <div class="md:flex md:items-center mb-6 justify-end">
                       <div class="md:flex md:items-center">
                           <div class="md:w-1/3"></div>
                           <div class="md:w-2/3">
                               <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                       type="submit"
                               >
                                   Salva
                               </button>
                           </div>
                       </div>
                   </div>
               </form>
           </div>
       </card-component>
    </div>
@endsection
