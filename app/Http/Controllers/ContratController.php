<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Societe;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Contrat::class);
        $contrats = Contrat::with('societe','vehicule')->get();
        return view('contrat.index',compact('contrats'));
    }

    public function create(){

        $societes = Societe::all();
        $vehicules = Vehicule::get();
        return view('contrat.create',compact('societes','vehicules'));
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
                'societe' => 'required|exists:societes,id',
                'vehicule' => 'required|exists:vehicules,id',
                'intervention_chaque' => 'integer|required',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
            ]);
            // $vehicule = Vehicule::whereId($request->vehicule)->firstOrFail();
            // if($vehicule->status == 1){

            //     return redirect()->back()->with('error','Vehicule déja Reserver');

            // }
            $contrat = Contrat::create([
                'societe_id' => $request->societe,
                'vehicule_id' => $request->vehicule,
                'intervention_chaque' => $request->intervention_chaque,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'status_id' => 1
            ]);

            $contrat->ref =  $contrat->id.date('m').'/'.date('Y');
            $contrat->update();

            return redirect()->route('Contrat.index')->with('success','Contrat Creer avec Succés');

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
                'societe_id' => 'required',
                'vehicule_id' => 'required',
                'status_id'=>'required'
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
        try {
            $this->authorize('delete', Contrat::class);

            $contrat = Contrat::whereId($id)->firstOrFail();
            $contrat->delete();
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
