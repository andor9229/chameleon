<?php

namespace App\Http\Controllers\ManageUser\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\ManageUser\Organization\Organization;
use App\Models\ManageUser\Role\Role;
use App\Models\User;
use App\Repositories\ManageUser\Organization\OrganizationRepository;
use App\Repositories\ManageUser\Organization\RoleRepository;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $organizationRepository;

    private $baseAbility;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
        $this->baseAbility = 'organization-';
    }

    public function index()
    {
        $this->authorize($this->baseAbility . 'index', Organization::class);

        return view('pages.manageUser.organization.index')
            ->withPageTitle('Organizzazioni')
            ->withType('index')
            ->withOrganizations($this->organizationRepository->getOrganizations());
    }

    public function show(Organization $organization)
    {
        $this->authorize($this->baseAbility . 'show', Organization::class);

        return view('pages.manageUser.organization.show')
            ->withPageTitle('')
            ->withOrganization($organization);
    }

    public function edit(Organization $organization)
    {
        $this->authorize($this->baseAbility . 'edit', Organization::class);

        return view('pages.manageUser.organization.create')
            ->withPageTitle('')
            ->withType('update')
            ->withOrganization($organization)
            ->withRoles(Role::all());
    }

    public function create()
    {
        $this->authorize($this->baseAbility . 'create', Organization::class);

        return view('pages.manageUser.organization.create')
            ->withPageTitle('')
            ->withType('create')
            ->withRoles(Role::all());
    }

    public function store(Request $request)
    {
        $this->authorize($this->baseAbility . 'store', Organization::class);

        try {
            $this->organizationRepository->store($request);

            return view('pages.manageUser.organization.index')
                ->withPageTitle('Organizzazioni')
                ->withType('index')
                ->withOrganizations($this->organizationRepository->getOrganizations());
        } catch (\Exception $e) {
            return view('pages.manageUser.role.create')
                ->withPageTitle('')
                ->withOrganizations(Organization::all())
                ->withError($e->getMessage());
        }
    }

    public function update(Request $request, Organization $organization)
    {
        $this->authorize($this->baseAbility . 'update', Organization::class);

        try {
            $this->organizationRepository->update($request, $organization);

            return view('pages.manageUser.organization.index')
                ->withPageTitle('Organizzazioni')
                ->withType('index')
                ->withOrganizations($this->organizationRepository->getOrganizations());
        } catch (\Exception $e) {
            return view('pages.manageUser.organization.create')
                ->withPageTitle('')
                ->withType('update')
                ->withOrganization($organization)
                ->withRoles(Role::all());
        }
    }

    public function destroy(Organization $organization)
    {
        $this->authorize($this->baseAbility . 'destroy', Organization::class);

        try {
            $this->organizationRepository->delete($organization);
            return [
                'status' =>  200,
                'body' => 'Organizzazione eliminata correttamente'
            ];
        } catch (\Exception $e) {
            return [
                'status' =>  400,
                'body' => $e->getMessage()
            ];
        }
    }

    public function forceDestroy($id)
    {
        $this->authorize($this->baseAbility . 'forcedestroy', Organization::class);

        try {
            $this->organizationRepository->destroy($id);
            return [
                'status' =>  200,
                'body' => 'Organizzazione eliminata correttamente'
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
        $this->authorize($this->baseAbility . 'restore', Organization::class);

        try {
            $organization = $this->organizationRepository->getWithTrashById($id);
            $organization->restore();

            return view('pages.manageUser.organization.index')
                ->withNotification('Organizzazione recuperata correttamente')
                ->withPageTitle('Organizzazioni')
                ->withType('index')
                ->withOrganizations($this->organizationRepository->getOrganizations());

        } catch (\Exception $e) {
            return view('pages.manageUser.organization.index')
                ->withError('Errore nel recupero')
                ->withPageTitle('Utenti')
                ->withType('index')
                ->withOrganizations($this->organizationRepository->getOrganizations());
        }
    }

    public function trash()
    {
        $this->authorize($this->baseAbility . 'trash', Organization::class);

        return view('pages.manageUser.organization.index')
            ->withPageTitle('Cestino Organizzazioni')
            ->withType('trash')
            ->withOrganizations($this->organizationRepository->getOrganizationsDeleted());
    }

    public function all()
    {
        return $this->organizationRepository->all();
    }
}
