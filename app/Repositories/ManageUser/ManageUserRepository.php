<?php

namespace App\Repositories\ManageUser;

use App\Models\ManageUser\Organization\Organization;
use App\Models\ManageUser\Permission\Permission;
use App\Models\ManageUser\Role\Role;
use App\Models\User;

class ManageUserRepository
{
    public function getRoles()
    {
        return Role::paginate(5);
    }

    public function getOrganizations()
    {
        return Organization::paginate(5);
    }

    public function getPermissions()
    {
        return Permission::paginate(5);
    }
}
