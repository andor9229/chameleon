<?php


namespace App\Repositories\ManageUser\User;



use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserRepository
{
    public function getUsers()
    {
        return User::paginate(5);
    }

    public function getDeletedUsers()
    {
        return User::onlyTrashed()->paginate(5);
    }

    public function getWithTrashById($id)
    {
        return User::withTrashed()->find($id);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'normalizeName' => normalizeString($request->name),
            'avatar' => generateAvatar(),
            'password' => bcrypt('password'),
            'api_token' => Str::random(60),
        ]);

        if($request->has('organization')) {
            $user->organizations()->attach($request->organization);
        }
    }

    public function update($request, $user)
    {
        if($request->has('organizations')) {
            $user->organizations()->detach();
            $user->organizations()->attach($request->organization);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    }

    public function destroy(User $user)
    {
        return $user->delete();
    }

    public function forceDestroy($id)
    {
        $user = User::onlyTrashed()->find($id);
        return $user->forceDelete();
    }
}
