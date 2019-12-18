<?php

namespace App\Models\ManageUser\Organization;

use App\Models\ManageUser\Role\Role;
use App\Models\Namirial\Account;
use App\Models\Namirial\NamirialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'normalizeName'];

    protected $createViewHidden = [
        'normalizeName',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRoles()
    {
        return $this->roles->pluck('normalizeName')->toArray();
    }

    /*public function getNamirialAccounts()
    {
        return $this->namirialAccounts();
    }*/

    public function namirialAccounts()
    {
        return $this->belongsToMany(
            Account::class,
            'namaccount_organization',
            'organization_id',
            'nam_account_id'
        );
    }

    public function namirialModels()
    {
        return $this->belongsToMany(
            NamirialModel::class,
            'namirialmodel_organization',
            'organization_id',
            'nam_model_id'
        );
    }

}
