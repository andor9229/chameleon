@extends('layouts.app')

@section('content')
    <div class="mb-10">
        <card-component class="w-full mb-8">
            <div slot="header" class="w-full flex justify-between">
                <h3>Utenti</h3>
                <form action="{{ route('manageUser.user.create') }}" method="get">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        type="submit"
                    >
                        Crea utente
                    </button>
                </form>

            </div>
            <div slot="body" style="overflow-x: scroll; width: 100%">
                @include('pages.manageUser.user.index')
            </div>
        </card-component>
        <card-component class="w-full mb-8">
            <div slot="header">
                <h3>Organizzazioni</h3>
            </div>
            <div slot="body" style="overflow-x: scroll; width: 100%">
                @include('pages.manageUser.organization.index')
            </div>
        </card-component>
        <card-component class="w-full mb-8">
            <div slot="header">
                <h3>Ruoli</h3>
            </div>
            <div slot="body" style="overflow-x: scroll; width: 100%">
                @include('pages.manageUser.role.index')
            </div>
        </card-component>
        <card-component class="w-full mb-8">
            <div slot="header">
                <h3>Permessi</h3>
            </div>
            <div slot="body" style="overflow-x: scroll; width: 100%">
                @include('pages.manageUser.permission.index')
            </div>
        </card-component>
    </div>
@endsection
