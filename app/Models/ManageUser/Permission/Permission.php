<?php

namespace App\Models\ManageUser\Permission;

use App\Models\ManageUser\Role\Role;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRolesName()
    {
        return $this->roles->pluck('name')->toArray();
    }

}
