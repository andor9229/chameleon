<?php

namespace Tests;

use App\Models\ManageUser\Organization\Organization;
use App\Models\ManageUser\Permission\Permission;
use App\Models\ManageUser\Role\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected function signIn($user = null)
    {
        $user = $user ?: factory(User::class)->create();

        $this->actingAs($user);

        return $user;
    }

    protected function makeOrganization($attributes = [])
    {
        $organization = factory(Organization::class)->create($attributes);

        return $organization;
    }

    protected function makeRole($attributes = [])
    {
        $role = factory(Role::class)->create($attributes);

        return $role;
    }

    protected function makeEnergyOperator($user)
    {
        $organization = $this->makeOrganization([
            'name' => 'Sala Energia - Operatori',
            'normalizeName' => normalizeString('Sala Energia - Operatori')
        ]);

        $role = $this->makeRole([
            'name' => 'Operator',
            'normalizeName' => normalizeString('Operator')
        ]);

        $user->organizations()->sync($organization);
        $organization->roles()->sync($role);

        return $organization;
    }

    protected function makeSupport($user)
    {
        $organization = $this->makeOrganization([
            'name' => 'Support',
            'normalizeName' => normalizeString('Support')
        ]);

        $role = $this->makeRole([
            'name' => 'Admin',
            'normalizeName' => normalizeString('Admin')
        ]);
        $permissions = Permission::pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        $user->organizations()->sync($organization);
        $organization->roles()->sync($role);
        return $organization;
    }

    protected function makePermissions($model)
    {
        $actions = [
            'index',
            'show',
            'edit',
            'create',
            'store',
            'update',
            'trash',
            'destroy',
            'forceDestroy'
        ];

        foreach ($actions as $index => $action) {
            factory(Permission::class)->create([
                'action' => $action,
                'controller' => ucfirst($model) . 'Controller',
                'slug' => $model . '-' . $action
            ]);
        }

    }
}
