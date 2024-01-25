<?php

namespace App\Http\Controllers;

use App\Models\Hayon;
use App\Models\TypeHayon;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class HayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Hayon::class);

        $hayons = Hayon::with('vehicule', 'typehayon')->get();
        return view('hayon.index', compact('hayons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Hayon::class);

        $vehicules = Vehicule::whereDoesntHave('hayon')->get();
        $types = TypeHayon::all();
        return view('hayon.create', compact('vehicules', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Hayon::class);

        $request->validate([
            'type' => 'required|exists:type_hayons,id',
            'vehicule' => 'required|exists:vehicules,id',
            'numero_serie' => 'required|unique:hayons,serie',
            'pdf' => 'nullable|mimes:pdf',
            'capacite'=>'required|numeric'
        ]);

        $file = '';
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');

            $file = $pdf->store('files', 'public');
        }
        $hayon =Hayon::create([
            'vehicule_id' => $request->vehicule,
            'serie' => $request->numero_serie,
            'type_hayon_id' => $request->type,
            'capacite' => $request->capacite,

            'pdf' => $file
        ]);
        $hayon->vehicules()->attach($hayon->vehicule_id);


        return redirect()->route('Hayon.index')->with('success', 'Hayon Créer avec Succés');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('viewAny', Hayon::class);

        $hayon = Hayon::whereId($id)->with('vehicule', 'vehicules','vehicules.societe','typehayon')->firstOrFail();
        return view('hayon.show',compact('hayon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update', Hayon::class);

        $vehicules = Vehicule::whereDoesntHave('hayon')->get();
        $types = TypeHayon::all();
        $hayon = Hayon::whereId($id)->firstOrFail();
        return view('hayon.edit', compact('vehicules', 'types', 'hayon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->authorize('update', Hayon::class);

        $request->validate([
            'type' => 'required|exists:type_hayons,id',
            'vehicule' => 'required|exists:vehicules,id',
            'numero_serie' => 'required|unique:hayons,serie,'.$id,
            'pdf' => 'nullable|mimes:pdf',
            'capacite'=>'required|numeric'
        ]);

        $hayon = Hayon::whereId($id)->firstOrFail();

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $file = $pdf->store('files', 'public');
            $hayon->pdf = $file;
        }
        if($hayon->vehicule_id != $request->vehicule){
            $hayon->vehicules()->attach($hayon->vehicule_id);
        }
        $hayon->vehicule_id = $request->vehicule;
        $hayon->serie = $request->numero_serie;
        $hayon->capacite = $request->capacite;
        $hayon->type_hayon_id = $request->type;
        $hayon->update();

        return redirect()->route('Hayon.index')->with('success', 'Hayon Modifier avec Succés');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', Hayon::class);

        $hayon = Hayon::whereId($id)->firstOrFail();
        $hayon->delete();

        return redirect()->route('Hayon.index')->with('success', 'Hayon Supprimer avec Succés');

    }

    public function deleted()
    {
        $this->authorize('restore', Hayon::class);

        $hayons = Hayon::onlyTrashed()->with('vehicule', 'typehayon')->get();
        return view('Hayon.deleted',compact('hayons'));
    }

    public function restore($id)
    {
        $this->authorize('restore', Hayon::class);

        $hayon = Hayon::whereId($id)->withTrashed()->firstOrFail();
        $hayon->restore();

        return redirect()->route('Hayon.index')->with('success', 'Hayon Supprimer avec Succés');

    }

}
