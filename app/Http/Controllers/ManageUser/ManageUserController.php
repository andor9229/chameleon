<?php

namespace App\Http\Controllers\ManageUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\ManageUser\ManageUserRepository;

class ManageUserController extends Controller
{
    /**
     * @var ManageUserRepository
     */
    private $manageUserRepository;

    public function __construct(ManageUserRepository $manageUserRepository)
    {
        $this->manageUserRepository = $manageUserRepository;
    }

    public function index()
    {
        $this->authorize('manage', User::class);

        return view('pages.manageUser.index')
            ->withPageTitle('Gestione Utenti')
            ->withUsers($this->manageUserRepository->getUsers())
            ->withRoles($this->manageUserRepository->getRoles())
            ->withOrganizations($this->manageUserRepository->getOrganizations())
            ->withPermissions($this->manageUserRepository->getPermissions());
    }
}
