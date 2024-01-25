<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
         /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Ville::class);

        $villes = Ville::all();
        return view('Ville.index', compact('villes'));
    }


    public function create()
    {
        $this->authorize('create', Ville::class);

        return view('Ville.create');
    }
    /**
     * Store a newly created resource in storage.
     *  @bodyParam type string  required unique
     */
    public function store(Request $request)
    {

        $this->authorize('create', Ville::class);

        $request->validate([
            'ville' => 'required|unique:villes,ville'
        ]);

        Ville::create([
            'ville' => $request->ville
        ]);
        return redirect()->route('Ville.index')->with('success', 'ville Créer avec Succés');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $this->authorize('update', Ville::class);

        $ville = Ville::whereId($id)->first();
        return view('Ville.edit', compact('ville'));
    }


    /**
     * Update the specified resource in storage.
     * @queryParam id int
     *  @bodyParam ville string  required unique
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Ville::class);

        $request->validate([
            'ville' => 'required|unique:villes,ville,' . $id
        ]);
        $ville = Ville::whereId($id)->firstOrFail();
        $ville->ville = $request->ville;
        $ville->update();

        return redirect()->route('Ville.index')->with('success', 'ville Modifier avec Succés');
    }

    /**
     * Remove the specified resource from storage.
     * @queryParam id int
     */
    public function destroy($id)
    {
        $this->authorize('delete', Ville::class);

        $ville = Ville::whereId($id)->firstOrFail();
        $ville->delete();
        return redirect()->route('Ville.index')->with('success', 'ville Supprimer avec Succés');
    }
    /**
     * List of deleted resources
     */
    public function deleted()
    {
        $this->authorize('restore', Ville::class);
        $villes = Ville::onlyTrashed()->get();
        return view('Ville.deleted', compact('villes'));
    }
    /**
     * Restore the specified resource from storage.
     * @queryParam id int
     */
    public function restore($id)
    {
        $this->authorize('restore', Ville::class);
        $ville = Ville::withTrashed()->whereId($id)->firstOrFail();
        $ville->restore();
        return redirect()->route('Ville.index')->with('success', 'ville Restaurer avec Succés');
    }
}
