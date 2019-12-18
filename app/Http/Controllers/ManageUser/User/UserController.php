<?php

namespace App\Http\Controllers\ManageUser\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\ManageUser\Organization\Organization;
use App\Models\User;
use App\Repositories\ManageUser\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    private $baseAbility;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->baseAbility = 'user-';
    }

    public function index()
    {
        $this->authorize($this->baseAbility . 'index', User::class);

        return view('pages.manageUser.user.index')
            ->withPageTitle('Utenti')
            ->withType('index')
            ->withUsers($this->userRepository->getUsers());
    }

    public function show(User $user)
    {
        $this->authorize($this->baseAbility . 'show', User::class);

        return view('pages.manageUser.user.show')
            ->withPageTitle('')
            ->withUser($user);
    }

    public function edit(User $user)
    {
        $this->authorize($this->baseAbility . 'edit', User::class);

        return view('pages.manageUser.user.create')
            ->withPageTitle('')
            ->withType('update')
            ->withUser($user)
            ->withOrganizations(Organization::all());
    }

    public function create()
    {
        $this->authorize($this->baseAbility . 'create', User::class);

        return view('pages.manageUser.user.create')
            ->withPageTitle('')
            ->withType('create')
            ->withOrganizations(Organization::all());
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize($this->baseAbility . 'update', User::class);

        try {
            $this->userRepository->update($request, $user);

            return view('pages.manageUser.user.index')
                ->withPageTitle('Utenti')
                ->withType('index')
                ->withUsers($this->userRepository->getUsers());
        } catch (\Exception $e) {
            return view('pages.manageUser.user.create')
                ->withPageTitle('')
                ->withOrganizations(Organization::all())
                ->withError($e->getMessage());
        }
    }

    public function store(UserRequest $request)
    {
        $this->authorize($this->baseAbility . 'store', User::class);

        try {
            $this->userRepository->store($request);

            return view('pages.manageUser.user.index')
                ->withPageTitle('Utenti')
                ->withType('index')
                ->withUsers($this->userRepository->getUsers());
        } catch (\Exception $e) {
            return view('pages.manageUser.user.create')
                ->withPageTitle('')
                ->withOrganizations(Organization::all())
                ->withError($e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        $this->authorize($this->baseAbility . 'destroy', User::class);

        try {
            $this->userRepository->destroy($user);
            return [
                'status' =>  200,
                'body' => 'Utente eliminato correttamente'
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
        $this->authorize($this->baseAbility . 'forcedestroy', User::class);

        try {
            $this->userRepository->forceDestroy($id);
            return [
                'status' =>  200,
                'body' => 'Utente eliminato correttamente'
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
        try {
            $user = $this->userRepository->getWithTrashById($id);
            $user->restore();

            return view('pages.manageUser.user.index')
                ->withNotification('Utente recuperato correttamente')
                ->withPageTitle('Utenti')
                ->withType('index')
                ->withUsers($this->userRepository->getUsers());

        } catch (\Exception $e) {
            return view('pages.manageUser.user.index')
                ->withError('Errore nel recupero')
                ->withPageTitle('Utenti')
                ->withType('index')
                ->withUsers($this->userRepository->getUsers());
        }
    }

    public function trash()
    {
        return view('pages.manageUser.user.index')
            ->withPageTitle('Cestino Utenti')
            ->withType('trash')
            ->withUsers($this->userRepository->getDeletedUsers());
    }
}
