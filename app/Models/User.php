<?php

namespace App\Models;

use App\Models\ManageUser\Organization\Organization;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use \Illuminate\Auth\MustVerifyEmail;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get name initials.
     *
     * @return string
     */
    public function getInitials()
    {
        return collect(explode(' ', $this->name))->map(function ($value) {
            return $value[0];
        })->implode('');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function hasPermission($roles)
    {
        $organizations = $this->organizations;
        foreach ($organizations as $index => $organization) {
            $organization_roles = $organization->getRoles();
            foreach ($organization_roles as $index => $organization_role) {
                if(in_array($organization_role, $roles)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getOrganizations()
    {
        return $this->organizations();
    }

}
