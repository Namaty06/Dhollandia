<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\TypeVehicule;
use Illuminate\Http\Request;

/**
 * @group Type Vehicule Management
 * API TO Manage Type Vehicule
 */
class TypeVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Configuration::class);

        $types = TypeVehicule::all();
        return view('typevehicule.index', compact('types'));
    }


    public function create()
    {
        $this->authorize('create', Configuration::class);
        return view('typevehicule.create');
    }
    /**
     * Store a newly created resource in storage.
     *  @bodyParam type string  required unique
     */
    public function store(Request $request)
    {

        $this->authorize('create', Configuration::class);

        $request->validate([
            'type' => 'required|unique:type_vehicules,type'
        ]);
        TypeVehicule::create([
            'type' => $request->type
        ]);
        return redirect()->route('TypeVehicule.index')->with('success', 'Type Créer avec Succés');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $this->authorize('update', Configuration::class);
        $type = TypeVehicule::whereId($id)->first();
        return view('typevehicule.edit', compact('type'));
    }


    /**
     * Update the specified resource in storage.
     * @queryParam id int
     *  @bodyParam type string  required unique
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Configuration::class);

        $request->validate([
            'type' => 'required|unique:type_vehicules,type,' . $id
        ]);
        $type = TypeVehicule::whereId($id)->firstOrFail();
        $type->type = $request->type;
        $type->update();

        return redirect()->route('TypeVehicule.index')->with('success', 'Type Modifier avec Succés');
    }

    /**
     * Remove the specified resource from storage.
     * @queryParam id int
     */
    public function destroy($id)
    {
        $this->authorize('delete', Configuration::class);

        $type = TypeVehicule::whereId($id)->firstOrFail();
        $type->delete();
        return redirect()->route('TypeVehicule.index')->with('success', 'Type Supprimer avec Succés');
    }
    /**
     * List of deleted resources
     */
    public function deleted()
    {
        $this->authorize('restore', Configuration::class);
        $types = TypeVehicule::onlyTrashed()->get();
        return view('typevehicule.deleted', compact('types'));
    }
    /**
     * Restore the specified resource from storage.
     * @queryParam id int
     */
    public function restore($id)
    {
        $this->authorize('restore', Configuration::class);

        $type = TypeVehicule::withTrashed()->whereId($id)->firstOrFail();
        $type->restore();
        return redirect()->route('TypeVehicule.index')->with('success', 'Type Restaurer avec Succés');
    }

}
