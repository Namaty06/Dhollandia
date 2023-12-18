<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Intervention;
use App\Models\Reclamation;
use App\Models\Societe;
use App\Models\User;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReclamationController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Reclamation::class);

        $interventions = Intervention::whereHasMorph('interventionable', Reclamation::class)->with('interventionable')->get();

        // Retrieve interventions where the morphed relationship is a Contract and meets the condition
        $interventionsContract = Intervention::whereHasMorph('interventionable', Contrat::class)->with('interventionable')->get();
        dd($interventions,$interventionsContract);

        $reclamations = Reclamation::with('societe','user','vehicule')->latest()->get();


        return view('reclamation.index',compact('reclamations'));
    }


    public function create()
    {
        $this->authorize('create', Reclamation::class);
        $vehicules = Vehicule::all();
        $societes = Societe::all();
        $users = User::all();

        return view('reclamation.create',compact('users','societes','vehicules'));
    }
    /**
     * Store a newly created resource in storage.
     *  @bodyParam type string  required unique
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicule_id'=>'required',
            'societe_id'=>'required',
            'user_id'=>'required'
        ]);
        $currentDateTime = Carbon::now();
        $count = 1;
        $ref = "REC".$count.'/'.$currentDateTime->month.'/'.$currentDateTime->year;
        $reclamation = Reclamation::create([
            'vehicule_id'=>$request->vehicule_id,
            'societe_id'=>$request->societe_id,
            'user_id'=>$request->user_id,
            'ref'=>$ref,
            'status_id'=>1
        ]);
        $reclamation->interventions()->create([
            'status_id'=>1,
            'date_intervention'=>now()
        ]);

        return redirect()->route('home')->with('success','Reclamation Créer avec Succés');

    }

    public function show($id)
    {

        $reclamation = Reclamation::whereId($id)->with('interventions')->first();

        return view('reclamation.show',compact('reclamation'));

    }

    public function edit($id)
    {

    }


    /**
     * Update the specified resource in storage.
     * @queryParam id int
     *  @bodyParam type string  required unique
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     * @queryParam id int
     */
    public function destroy($id)
    {

    }
    /**
     * List of deleted resources
     */
    public function deleted()
    {

    }
    /**
     * Restore the specified resource from storage.
     * @queryParam id int
     */
    public function restore($id)
    {

    }

}
