<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Users Management
 * API TO Manage Users
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', User::class);
        $users = User::with('role')->get();;
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }


    public function show($id)
    {
        $this->authorize('viewAny', User::class);

        $user = User::whereId($id)->firstOrFail();
        return redirect()->route('User.index')->with('success', 'Utilisateur Desactiver avec Succés');
    }
    /**
     * Store a newly created resource in storage.
     *  @bodyParam email  unique required
     *  @bodyParam password string  required
     *  @bodyParam name string  required
     *  @bodyParam role   required
     *  @bodyParam telephone nullable 0600000000
     *
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'email' => 'email|required|unique:users,email',
            'password' => 'required',
            'name' => 'required',
            'role_id' => 'required',
            'telephone' => 'nullable|min:10|max:10'
        ]);

        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'role_id' => $request->role_id
        ]);

        return redirect()->route('User.index')->with('success', 'Utilisateur Créer avec Succés');
    }


    /**
     * Update the specified resource in storage.
     *  @queryParam id int
     *  @bodyParam email  unique required
     *  @bodyParam name string  required
     *  @bodyParam role   required
     *  @bodyParam telephone nullable 0600000000
     *
     */

    public function edit($id)
    {
        $this->authorize('update', User::class);

        $user = User::whereId($id)->with('role')->firstOrFail();
        $roles = Role::where('id', '!=', $user->role_id)->get();

        return view('users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, string $id)
    {

        $this->authorize('update', User::class);

        $request->validate([
            'email' => 'email|required',
            'name' => 'required',
            'role_id' => 'required',
            'password' => 'nullable|min:6',
            'telephone' => 'nullable|min:10|max:10'

        ]);
        $user = User::whereId($id)->firstOrFail();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->telephone = $request->telephone;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return redirect()->route('User.index')->with('success', 'Utilisateur Modifier avec Succés');
    }

    /**
     * Delete the specified resource from storage.
     *   @queryParam id int
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);

        $user = User::whereId($id)->firstOrFail();
        $user->delete();
        return redirect()->route('User.index')->with('success', 'Utilisateur Desactiver avec Succés');
    }

    /**
     * List of Deleted resources
     */

    public function deleted()
    {
        $this->authorize('restore', User::class);
        $users = User::onlyTrashed()->get();
        return view('users.deleted', compact('users'));
    }
    /**
     * Restore the specified resource
     * @queryParam id int
     */

    public function restore($id)
    {
        $this->authorize('restore', User::class);
        $user = User::withTrashed()->whereId($id)->firstOrFail();
        $user->restore();

        return redirect()->route('User.index')->with('success', 'Utilisateur Activer avec Succés');

    }
}
