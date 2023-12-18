<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;


/**
 * @group Role Management
 * API TO Manage Role
 */
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::with('permission')->get();
        $permissions = Permission::all();
        return view('role.index', compact('roles', 'permissions'));
    }



    /**
     * Store a newly created resource in storage.
     * @bodyParam role string required unique
     * @bodyParam permission array of permissions ids
     */
    public function store(Request $request)
    {
        $this->authorize('viewAny', Role::class);

        if ($request->has('permission')) {
            $role = Role::whereId($request->role_id)->with('permission')->firstOrFail();

            $role->permission()->detach();
            $permissions = Permission::whereIn('id', $request->permission)->get();
            foreach ($permissions as $permission) {
                $role->permission()->attach($permission->id);
            }
        }
        return redirect()->back()->with('success','Mofifier avec Succés');
    }



    /**
     * Update the specified resource in storage.
     * @queryParam id int
     * @bodyParam role string required unique
     * @bodyParam permission array of permissions ids
     */
    public function update(Request $request, $id)
    {
        $this->authorize('viewAny', Role::class);

        try {
            $request->validate([
                'role' => 'required|unique:roles,role,' . $id,
                'permission' => 'array|required'

            ]);
            $role = Role::whereId($id)->firstOrFail();
            $role->role = $request->role;
            $role->update();
            if ($request->has('permission')) {
                $role->permission()->detach();
                $permissions = Permission::whereIn('id', $request->permission)->get();
                foreach ($permissions as $permission) {
                    $role->permission()->attach($permission->id);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'success'
                ], 200);
            }
            return response()->json([
                'status' => true,
                'message' => 'Successfuly'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @queryParam id int
     */
    public function destroy($id)
    {
        try {
            $this->authorize('viewAny', Role::class);

            $role = Role::whereId($id)->firstOrFail();
            $role->delete();
            return response()->json([
                'status' => true,
                'message' => 'Successfuly'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * List of deleted resources from storage.
     */

    public function deleted()
    {
        try {
            $this->authorize('viewAny', Role::class);

            $roles = Role::onlyTrashed()->get();
            return response()->json($roles);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Restore the specified resource from storage.
     * @queryParam id int
     *
     */
    public function restore($id)
    {
        try {
            $this->authorize('viewAny', Role::class);

            $role = Role::withTrashed()->whereId($id)->firstOrFail();
            $role->restore();
            return response()->json([
                'status' => true,
                'message' => 'Successfuly'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
