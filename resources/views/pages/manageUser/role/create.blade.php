@extends('layouts.app')

@section('content')
    <div class="flex mb-10 justify-center">
       <card-component class="w-full">
           <div slot="header">
               @if($type === 'create')
                   <h3 slot="header">Crea Nuovo Ruolo</h3>
               @else
                   <h3 slot="header">Modifica Ruolo</h3>
               @endif
           </div>

           <div slot="body">
               <form class="w-4/5" method="POST" action="{{ $type === 'create' ? route('manageUser.role.store') : route('manageUser.role.update', [ 'role' => $role->id ]) }}" >
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
                               class="bg-gray-200 appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200'}}"
                               id="inline-full-name"
                               value="{{ $type === 'update' ? $role->name : '' }}"
                           >
                           @error('name')
                           <p class="text-red-500 text-xs italic">{{ $message }}</p>
                           @enderror
                       </div>
                   </div>
                   <div class="md:flex md:items-center mb-6">
                       <div class="md:w-1/3">
                           <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                               Seleziona il permesso
                           </label>
                       </div>
                       <div class="md:w-2/3">
                           <select
                               class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               id="permissions"
                               name="permissions[]"
                               multiple
                           >
                               <option value="Seleziona il permesso">Seleziona il permesso</option>
                               @foreach($permissions as $permission)
                                   <option value="{{ $permission->id }}" {{ $type === 'update' &&  in_array($permission->slug, $role->permissions()->pluck('slug')->toArray()) ? "selected" : ''}}>{{ $permission->slug }}</option>
                               @endforeach
                           </select>
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
