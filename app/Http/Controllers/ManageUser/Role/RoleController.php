<?php

namespace App\Http\Controllers\ManageUser\Role;

use App\Http\Controllers\Controller;
use App\Models\ManageUser\Permission\Permission;
use App\Models\ManageUser\Role\Role;
use App\Models\User;
use App\Repositories\ManageUser\Role\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $this->authorize('manage', User::class);

        return view('pages.manageUser.role.index')
            ->withPageTitle('Ruoli')
            ->withType('index')
            ->withRoles($this->roleRepository->getRoles());
    }

    public function show(Role $role)
    {
        $this->authorize('manage', User::class);

        return view('pages.manageUser.role.show')
            ->withPageTitle('')
            ->withRole($role);
    }

    public function edit(Role $role)
    {
        $this->authorize('manage', User::class);

        return view('pages.manageUser.role.create')
            ->withPageTitle('')
            ->withType('update')
            ->withRole($role)
            ->withPermissions(Permission::all());
    }

    public function create()
    {
        $this->authorize('manage', User::class);

        return view('pages.manageUser.role.create')
            ->withPageTitle('')
            ->withType('create')
            ->withPermissions(Permission::all());
    }

    public function store(Request $request)
    {
        $this->authorize('manage', User::class);

        $this->authorize('manage', User::class);

        try {
            $this->roleRepository->store($request);

            return view('pages.manageUser.role.index')
                ->withPageTitle('Ruoli')
                ->withType('index')
                ->withRoles($this->roleRepository->getRoles());
        } catch (\Exception $e) {
            return view('pages.manageUser.role.create')
                ->withPageTitle('')
                ->withRoles(Role::all())
                ->withError($e->getMessage());
        }
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('manage', User::class);

        try {
            $this->roleRepository->update($request, $role);

            return view('pages.manageUser.role.index')
                ->withPageTitle('Ruoli')
                ->withType('index')
                ->withRoles($this->roleRepository->getRoles());
        } catch (\Exception $e) {
            return view('pages.manageUser.role.create')
                ->withPageTitle('')
                ->withType('update')
                ->withRole($role)
                ->withPermissions(Permission::all());
        }
    }

    public function delete(Role $role)
    {
        $this->authorize('manage', User::class);

        try {
            $this->roleRepository->delete($role);
            return [
                'status' =>  200,
                'body' => 'Ruolo eliminato correttamente'
            ];
        } catch (\Exception $e) {
            return [
                'status' =>  400,
                'body' => $e->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        $this->authorize('manage', User::class);

        try {
            $this->roleRepository->destroy($id);
            return [
                'status' =>  200,
                'body' => 'Ruolo eliminato correttamente'
            ];
        } catch (\Exception $e) {
            return [
                'status' =>  400,
                'body' => $e->getMessage()
            ];
        }
    }

    public function restore($id)
    {
        $this->authorize('manage', User::class);

        try {
            $organization = $this->roleRepository->getWithTrashById($id);
            $organization->restore();

            return view('pages.manageUser.role.index')
                ->withNotification('Ruolo recuperato correttamente')
                ->withPageTitle('Ruoli')
                ->withType('index')
                ->withRoles($this->roleRepository->getRoles());

        } catch (\Exception $e) {
            return view('pages.manageUser.role.index')
                ->withError('Errore nel recupero')
                ->withPageTitle('Utenti')
                ->withType('index')
                ->withRoles($this->roleRepository->getRoles());
        }
    }

    public function trash()
    {
        $this->authorize('manage', User::class);

        return view('pages.manageUser.role.index')
            ->withPageTitle('Cestino Ruoli')
            ->withType('trash')
            ->withRoles($this->roleRepository->getRolesDeleted());
    }

    public function all()
    {
        return $this->roleRepository->all();
    }
}
