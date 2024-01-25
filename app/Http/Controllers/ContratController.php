<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Societe;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Contrat::class);
        $contrats = Contrat::with('societe', 'vehicule')->get();
        return view('contrat.index', compact('contrats'));
    }

    public function create()
    {
        $this->authorize('create', Contrat::class);

        $societes = Societe::get();
        $vehicules = Vehicule::get();
        return view('contrat.create', compact('societes', 'vehicules'));
    }

    public function show($id)
    {
        $this->authorize('viewAny', Contrat::class);
        $contrat = Contrat::whereId($id)->with('interventions', 'societe', 'vehicule', 'vehicules.hayon')->first();
        $vehicules = Vehicule::where('societe_id', $contrat->societe_id)->get();

        // dd($contrat);
        return view('contrat.show', compact('contrat', 'vehicules'));
    }

    /**
     * Store a newly created resource in storage.
     * @bodyParam ref string
     * @bodyParam societe_id
     * @bodyParam vehicule_id
     * @bodyParam intervention_chaque integer
     * @bodyParam date_debut date
     * @bodyParam date_fin date
     *
     */
    public function store(Request $request)
    {
        $this->authorize('create', Contrat::class);

        $request->validate([
            'ref' => 'required|unique:contrats,ref',
            'societe' => 'required|exists:societes,id',
            'intervention_chaque' => 'integer|required',
            'date_debut' => 'required|date',
            'day'=>'required|numeric|max:28',
            'periode'=>'required|numeric|min:1'
        ]);

        $inputDate = $request->date_debut;
        $carbonDate = Carbon::parse($inputDate);
        $newDate = $carbonDate->addYears($request->periode);

        Contrat::create([
            'ref' => $request->ref,
            'societe_id' => $request->societe,
            'intervention_chaque' => $request->intervention_chaque,
            'date_debut' => $request->date_debut,
            'date_fin' => $newDate,
            'status_id' => 1,
            'periode' => $request->periode,
            'day' => $request->day
        ]);

        return redirect()->route('Contrat.index')->with('success', 'Contrat Créer avec Succés');

    }

    /**
     * Update the specified resource in storage.
     * @queryParam id int
     * @bodyParam societe_id
     * @bodyParam vehicule_id
     * @bodyParam status_id
     */
    public function update(Request $request, $id)
    {

        try {
            $this->authorize('update', Contrat::class);

            $request->validate([
                'societe' => 'required|exists:societes,id',
                'vehicule' => 'required|exists:vehicules,id',
                'status_id' => 'required'
            ]);

            $contrat = Contrat::whereId($id)->firstOrFail();
            $contrat->societe_id = $request->societe_id;
            $contrat->vehicule_id = $request->vehicule_id;
            $contrat->status_id = $request->status_id;
            $contrat->update();

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
        // try {
        //     $this->authorize('delete', Contrat::class);

        //     $contrat = Contrat::whereId($id)->firstOrFail();
        //     $contrat->delete();
        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Successfuly'
        //     ], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $th->getMessage()
        //     ], 500);
        // }
    }
    /**
     * Remove the specified resource from storage.
     * @queryParam id int
     */
    public function deleted()
    {
        try {
            $this->authorize('restore', Contrat::class);
            $contrats = Contrat::onlyTrashed()->get();
            return response()->json($contrats);
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
    public function restore($id)
    {
        try {
            $this->authorize('restore', Contrat::class);
            $contrat = Contrat::withTrashed()->whereId($id)->firstOrFail();
            $contrat->restore();
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
