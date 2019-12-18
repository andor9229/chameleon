<table class="table border w-full">
    <tr class="">
        <th>Id</th>
        <th>Action</th>
        <th>Controller</th>
        <th>Slug</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    @foreach($permissions as $permission)
        <tr class="">
            <td >{{ $permission->id }}</td>
            <td>{{ $permission->action }}</td>
            <td>{{ $permission->controller }}</td>
            <td>{{ $permission->slug }}</td>
            <td>{{ $permission->created_at }}</td>
            <td>{{ $permission->updated_at }}</td>
        </tr>
    @endforeach
</table>
{{ $permissions->links() }}
