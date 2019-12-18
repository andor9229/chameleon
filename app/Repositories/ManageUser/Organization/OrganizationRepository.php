<?php

namespace App\Repositories\ManageUser\Organization;

use App\Models\ManageUser\Organization\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class OrganizationRepository
{
    public function getOrganizations()
    {
        return Organization::paginate(5);
    }

    public function getOrganizationsDeleted()
    {
        return Organization::onlyTrashed()->paginate(5);
    }

    public function getWithTrashById($id)
    {
        return Organization::withTrashed()->find($id);
    }

    public function store(Request $request)
    {
        $organization = Organization::create([
            'name' => $request->name,
            'normalizeName' => normalizeString($request->name)
        ]);

        if($request->has('role')) {
            $organization->roles()->attach($request->role);
        }
    }

    public function update($request, $organization)
    {
        if($request->has('organizations')) {
            $organization->roles()->detach();
            $organization->roles()->attach($request->role);
        }
        $organization->name = $request->name;
        $organization->normalizeName = normalizeString($request->name);
        $organization->save();
    }

    public function delete(Organization $organization)
    {
        return $organization->delete();
    }

    public function destroy($id)
    {
        $organization = Organization::onlyTrashed()->find($id);
        return $organization->forceDelete();
    }

    public function all()
    {
        return Organization::all();
    }
}
