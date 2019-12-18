<?php

namespace App\Models\ManageUser\Role;

use App\Models\ManageUser\Organization\Organization;
use App\Models\ManageUser\Permission\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'normalizeName'];

    protected $createViewHidden = [
        'normalizeName',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function getOrganizationsName()
    {
        return $this->organizations;
    }
}
