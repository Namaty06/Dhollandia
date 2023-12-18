<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @group Societe Management
 * API TO Manage Societe
 */
class SocieteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', Societe::class);
        $societes = Societe::all();
        return view('societe.index', compact('societes'));
    }


    public function create()
    {
        $this->authorize('create', Societe::class);
        return view('societe.create');
    }

    public function show($id)
    {

    }


    /**
     * Store a newly created resource in storage.
     * @bodyParam societe  unique required
     * @bodyParam email  unique required
     * @bodyParam responsable  unique
     * @bodyParam adresse date
     * @bodyParam telephone string
     * @bodyParam fix string
     * @bodyParam logo base64
     */
    public function store(Request $request)
    {

        $this->authorize('create', Societe::class);

        $request->validate([
            'societe' => 'required|unique:societes,societe',
            'responsable' => 'nullable',
            'adresse' => 'nullable',
            'tel' => 'nullable|max:10|min:10',
            'fix' => 'nullable|max:10|min:10',
            'email' => 'nullable|email'
        ]);

        $path = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
        }

        Societe::create([
            'societe' => $request->societe,
            'responsable' => $request->responsable,
            'adresse' => $request->adresse,
            'tel' => $request->telephone,
            'email' => $request->email,
            'fix' => $request->fix,
            'logo' => $path,
        ]);

        return redirect()->route('Societe.index')->with('success', 'Sociéte Ajouter avec Succés');
    }



    public function edit($id)
    {

        $societe = Societe::whereId($id)->first();
        return view('societe.edit', compact('societe'));
    }
    /**
     * Update the specified resource in storage.
     * * @queryParam id int
     * @bodyParam societe  unique required
     * @bodyParam responsable  unique
     * @bodyParam adresse date
     * @bodyParam telephone string
     * @bodyParam fix string
     * @bodyParam logo base64
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Societe::class);

        $request->validate([
            'societe' => 'required|unique:societes,societe,' . $id,
            'responsable' => 'nullable',
            'adresse' => 'nullable',
            'tel' => 'nullable|max:10|min:10',
            'fix' => 'nullable|max:10|min:10',
            'email' => 'nullable|email'
        ]);
        $societe =  Societe::whereId($id)->firstOrFail();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
        } else {
            $path = $societe->logo;
        }
        $societe->societe = $request->societe;
        $societe->responsable = $request->responsable;
        $societe->adresse = $request->adresse;
        $societe->telephone = $request->tel;
        $societe->email = $request->email;
        $societe->fix = $request->fix;
        $societe->logo = $path;
        $societe->update();

        return redirect()->route('Societe.index')->with('success', 'Sociéte Modifier avec Succés');
    }

    /**
     * Remove the specified resource from storage.
     * @queryParam id int
     */
    public function destroy($id)
    {

        $this->authorize('delete', Societe::class);
        $societe = Societe::whereId($id)->firstOrFail();
        $societe->delete();
        return redirect()->route('Societe.index')->with('success', 'Sociéte Supprimer avec Succés');
    }
    /**
     * List of Deleted resources .
     *
     */

    public function deleted()
    {
        $this->authorize('restore', Societe::class);

        $societes = Societe::onlyTrashed()->get();
        return view('societe.deleted', compact('societes'));
    }
    /**
     * Restore the specified resource from storage.
     * @queryParam id int
     */
    public function restore($id)
    {
            $this->authorize('restore', Societe::class);

            $societe = Societe::withTrashed()->whereId($id)->firstOrFail();
            $societe->restore();
            return redirect()->route('Societe.index')->with('success', 'Sociéte Restaurer avec Succés');

    }
}
