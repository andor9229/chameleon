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
                <h3>Utenti</h3>
                 @if($type === 'index')
                     <div class="flex justify-end">
                         <form action="{{ route('manageUser.user.trash') }}" method="get">
                             <button
                                 class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                                 type="submit"
                             >
                                 Cestino
                             </button>
                         </form>
                         <form action="{{ route('manageUser.user.create') }}" method="get">
                             <button
                                 class="ml-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                 type="submit"
                             >
                                 Crea utente
                             </button>
                         </form>
                     </div>

                    @endif
                    @if($type === 'trash')
                        <form action="{{ route('manageUser.user.index') }}">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    type="submit"
                                >
                                    Torna indietro
                                </button>
                        </form>
                    @endif
            </div>
                <table
                    :data="users"
                >

                </table>
            <div slot="body" style="overflow-x: scroll; width: 100%">
                <table class="table border w-full">
                    <tr>
                        <th>Actions</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Organizations</th>
                        <th>Api Token</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    @foreach($users as $user)
                        <tr class="items-center">
                            <td class="flex items-center">
                                @if($type === 'index')
                                    <a href="{{ route('manageUser.user.edit', [ 'user' => $user->id ]) }}" class="button-icon-gray items-center"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('manageUser.user.show', [ 'user' => $user->id ]) }}" class="button-icon-gray items-center"><i class="far fa-fw fa-eye"></i></a>
                                    <confirm-delete-component
                                        class="items-center"
                                        url="/manage-users/user/{{$user->id}}"
                                        resource="{{ $user }}"
                                        match="email"
                                        delete-message="Insersci l'email dell'utente che vuoi eliminare"
                                        location-href="/manage-users/user"
                                    ></confirm-delete-component>
                                @endif
                                @if($type === 'trash')
                                    <form method="post" action="{{ route('manageUser.user.restore', [ 'id' => $user->id ]) }}">
                                        @csrf
                                        <button type="submit" class="button-icon-gray items-center"><i class="fas fa-redo-alt"></i></button>
                                    </form>
                                    <confirm-delete-component
                                        class="items-center"
                                        url="/manage-users/user/{{$user->id}}/force-destroy"
                                        resource="{{ $user }}"
                                        match="email"
                                        delete-message="Insersci l'email dell'utente che vuoi eliminare"
                                        location-href="/manage-users/user"
                                    ></confirm-delete-component>
                                @endif
                            </td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ implode(', ', $user->organizations->pluck('name')->toArray()) }}</td>
                            <td>{{ $user->api_token }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                </table>
                {{ $users->links() }}
            </div>
        </card-component>
    </div>
@endsection
