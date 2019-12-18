<?php

namespace App\Repositories\ManageUser\Role;

use App\Models\ManageUser\Organization\Organization;
use App\Models\ManageUser\Role\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleRepository
{
    public function getRoles()
    {
        return Role::paginate(5);
    }

    public function getRolesDeleted()
    {
        return Role::onlyTrashed()->paginate(5);
    }

    public function getWithTrashById($id)
    {
        return Role::withTrashed()->find($id);
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'normalizeName' => normalizeString($request->name)
        ]);

        if($request->has('permissions')) {
            $role->permissions()->attach($request->permissions);
        }
    }

    public function update($request, $role)
    {
        if($request->has('permissions')) {
            $role->permissions()->detach();
            $role->permissions()->attach($request->permissions);
        }
        $role->name = $request->name;
        $role->normalizeName = normalizeString($request->name);
        $role->save();
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }

    public function destroy($id)
    {
        $role = Role::onlyTrashed()->find($id);
        return $role->forceDelete();
    }

    public function all()
    {
        return Organization::all();
    }
}
