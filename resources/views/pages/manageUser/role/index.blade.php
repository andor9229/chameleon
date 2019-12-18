@extends('layouts.app')

@section('content')
    <div class="mb-10">
        <card-component class="w-full mb-8">
            @if (session('notification'))
                <notification-component message=" {{ session('notification') }}" type="success"></notification-component>
            @endif

            @if (session('error'))
                <notification-component message=" {{ session('error') }}" type="error"></notification-component>
            @endif
            <div slot="header" class="w-full flex justify-between">
                <h3>Ruoli</h3>
                @if($type === 'index')
                    <div class="flex justify-end">
                        <form action="{{ route('manageUser.role.trash') }}" method="get">
                            <button
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                type="submit"
                            >
                                Cestino
                            </button>
                        </form>
                        <form action="{{ route('manageUser.role.create') }}" method="get">
                            <button
                                class="ml-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                type="submit"
                            >
                                Crea ruolo
                            </button>
                        </form>
                    </div>

                @endif
                @if($type === 'trash')
                    <form action="{{ route('manageUser.role.index') }}">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="submit"
                        >
                            Torna indietro
                        </button>
                    </form>
                @endif
            </div>
            <div slot="body" style="overflow-x: scroll; width: 100%">
                <table class="table border w-full">
                    <tr>
                        <th>Actions</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    @foreach($roles as $role)
                        <tr class="items-center">
                            <td class="flex items-center">
                                @if($type === 'index')
                                    <a href="{{ route('manageUser.role.edit', [ 'role' => $role->id ]) }}" class="button-icon-gray items-center"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('manageUser.role.show', [ 'role' => $role->id ]) }}" class="button-icon-gray items-center"><i class="far fa-fw fa-eye"></i></a>
                                    <confirm-delete-component
                                        class="items-center"
                                        url="/manage-users/role/{{ $role->id }}"
                                        resource="{{ $role }}"
                                        match="name"
                                        delete-message="Inserisci il nome del ruolo che vuoi eliminare"
                                        location-href="/manage-users/role"
                                    ></confirm-delete-component>
                                @endif
                                @if($type === 'trash')
                                    <form method="post" action="{{ route('manageUser.role.restore', [ 'id' => $role->id ]) }}">
                                        @csrf
                                        <button type="submit" class="button-icon-gray items-center"><i class="fas fa-redo-alt"></i></button>
                                    </form>
                                    <confirm-delete-component
                                        class="items-center"
                                        url="/manage-users/role/{{$role->id}}/destroy"
                                        resource="{{ $role }}"
                                        match="name"
                                        delete-message="Inserisci il nome del ruolo che vuoi eliminare"
                                        location-href="/manage-users/role"
                                    ></confirm-delete-component>
                                @endif
                            </td>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ implode(', ', $role->permissions->pluck('slug')->toArray()) }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                        </tr>
                    @endforeach
                </table>
                {{ $roles->links() }}
            </div>
        </card-component>
    </div>
@endsection
