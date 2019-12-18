<?php

namespace App\Providers;

use App\Models\Bridge;
use App\Models\Log\Activity;
use App\Models\Log\SourceAccessLog;
use App\Models\ManageUser\Permission\Permission;
use App\Models\ManageUser\Role\Role;
use App\Models\Organization;
use App\Models\Source;
use App\Models\SourceAccessToken;
use App\Models\User;
use App\Policies\ActivityPolicy;
use App\Policies\BridgePolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\SourceAccessLogPolicy;
use App\Policies\SourceAccessTokenPolicy;
use App\Policies\SourcePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if(Schema::hasTable('permissions')) {
            $permissions = $this->getPermissions();
            foreach ($permissions as $permission) {
                Gate::define($permission->slug, function($user) use($permission){
                    return $user->hasPermission($permission->roles->pluck('normalizeName')->toArray());
                });
            }
        }
    }

    /**
     * @return mixed
     */
    private function getPermissions()
    {
        return Permission::with('roles')->get();
    }

}
