<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\TypePanne;
use Illuminate\Http\Request;

class TypePanneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Configuration::class);

        $types = TypePanne::all();
        return view('typepanne.index', compact('types'));
    }


    public function create()
    {
        $this->authorize('create', Configuration::class);

        return view('typepanne.create');
    }
    /**
     * Store a newly created resource in storage.
     *  @bodyParam type string  required unique
     */
    public function store(Request $request)
    {

        $this->authorize('create', Configuration::class);

        $request->validate([
            'type' => 'required|unique:type_pannes,type'
        ]);
        TypePanne::create([
            'type' => $request->type
        ]);
        return redirect()->route('TypePanne.index')->with('success', 'Type Créer avec Succés');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $this->authorize('update', Configuration::class);

        $type = TypePanne::whereId($id)->first();
        return view('typepanne.edit', compact('type'));
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
            'type' => 'required|unique:type_pannes,type,' . $id
        ]);
        $type = TypePanne::whereId($id)->firstOrFail();
        $type->type = $request->type;
        $type->update();

        return redirect()->route('TypePanne.index')->with('success', 'Type Modifier avec Succés');
    }

    /**
     * Remove the specified resource from storage.
     * @queryParam id int
     */
    public function destroy($id)
    {
        $this->authorize('delete', Configuration::class);

        $type = TypePanne::whereId($id)->firstOrFail();
        $type->delete();
        return redirect()->route('TypePanne.index')->with('success', 'Type Supprimer avec Succés');
    }
    /**
     * List of deleted resources
     */
    public function deleted()
    {
        $this->authorize('restore', Configuration::class);
        $types = TypePanne::onlyTrashed()->get();
        return view('typepanne.deleted', compact('types'));
    }
    /**
     * Restore the specified resource from storage.
     * @queryParam id int
     */
    public function restore($id)
    {
        $this->authorize('restore', Configuration::class);

        $type = TypePanne::withTrashed()->whereId($id)->firstOrFail();
        $type->restore();
        return redirect()->route('TypePanne.index')->with('success', 'Type Restaurer avec Succés');
    }

}
