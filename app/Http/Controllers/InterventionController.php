<?php

namespace App\Http\Controllers;

use App\Mail\SendRapport;
use App\Models\Contrat;
use App\Models\Examen;
use App\Models\Intervention;
use App\Models\Rapport;
use App\Models\Reclamation;
use App\Models\Status;
use App\Models\TypeDocument;
use App\Models\TypePanne;
use App\Models\User;
use App\Models\Vehicule;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

/**
 * @group Intervention Management
 * API TO Manage Intervention
 */
class InterventionController extends Controller
{
    /**
     * Liste des Intervention Par Année.
     */
    public function index($year)
    {

        if (empty($year)) {
            $year = Carbon::now()->format('Y');
        }
        $interventions = Intervention::whereYear('date_intervention', $year)->with('status', 'contrat.vehicule.typevehicule', 'contrat.societe')->get();
        return response()->json($interventions);
    }

    public function filter(Request $request)
    {

        $year = $request->year;
        $month = $request->month;

        $interventions = Intervention::whereYear('date_intervention', $year)
            ->whereMonth('date_intervention', $month)
            ->with('status', 'interventionable.vehicule.typevehicule', 'interventionable.societe', 'typepanne',)
            ->get();

        return response()->json($interventions);
    }



    public function show($id)
    {
        $this->authorize('viewAny', Intervention::class);

        $intervention = Intervention::whereId($id)->with('document.typedocument')->whereHasMorph('interventionable', Reclamation::class)->first();

        // Retrieve interventions where the morphed relationship is a Contract and meets the condition
        $interventionsContract = Intervention::whereId($id)->whereHasMorph('interventionable', Contrat::class)->first();

        if ($intervention) {

            $typedocuments = TypeDocument::all();
            $reclamation = Reclamation::whereId($intervention->interventionable_id)->with('transport')->first();
            return view('intervention.showRec', compact('intervention', 'typedocuments', 'reclamation'));
        }
        if ($interventionsContract) {
            // $contrat = Contrat::whereId($intervention->interventionable_id)->first();

            return view('intervention.show', compact('interventionsContract'));
        }
        // $intervention = Intervention::whereId($id)
        //     ->with('status', 'contrat.vehicule.typevehicule', 'contrat.societe', 'contrat', 'rapport')->firstOrFail();
    }

    public function list()
    {
        $this->authorize('viewAny', Intervention::class);

        $interventions = Intervention::with('status')->latest()->get();
        return view('intervention.list', compact('interventions'));
    }


    public function create()
    {
        $this->authorize('create', Intervention::class);

        $contrats = Contrat::where('status_id', 1)->get();
        $users = User::where('role_id', 2)->get();
        $types = TypePanne::all();
        $nosvehicule = Vehicule::where('typevehicule_id', 1)->get();

        return view('intervention.create', compact('contrats', 'users', 'types', 'nosvehicule'));
    }

    public function gethayon($id)
    {

        $contrat = Contrat::whereId($id)->with('vehicules.hayon')->firstOrFail();
        return response()->json($contrat->vehicules);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Intervention::class);

        $request->validate([
            'hayon' => 'required',
            'date_intervention' => 'required',
            'user' => 'required',
            'contrat' => 'required'
        ]);
        $contrat = Contrat::whereId($request->contrat)->firstOrFail();

        $contrat->interventions()->create([
            'hayon_id' => $request->hayon,
            'date_intervention' => $request->date_intervention,
            'status_id' => 1,
            'user_id' => $request->user,
            'type_panne_id' => $request->type_panne_id
        ]);


        return redirect()->route('Intervention.list')->with('success', 'Intervention Créer avec Succés');
    }

    public function edit($id)
    {

        $inter = Intervention::whereId($id)->firstOrFail();
        // if($inter->){

        // }
        $statuses = Status::all();
        $users = User::where('role_id', 2)->get();
        $types = TypePanne::all();
        $nosvehicule = Vehicule::where('typevehicule_id', 1)->get();
        return view('intervention.edit', compact('statuses', 'users', 'types', 'nosvehicule','inter'));

    }




    /**
     * Update the specified resource in storage.P
     */
    public function update(Request $request, $id)
    {

        $this->authorize('update', Intervention::class);

        $request->validate([
            'hayon' => 'required',
            'date_intervention' => 'required',
            'user' => 'required',
        ]);

        $inter = Intervention::whereId($id)->firstOrFail();
        if ($inter->status_id != 1) {
            return response()->json([
                'status' => false,
                'message' => 'Intervention n est pas encours '
            ], 401);
        }

        $inter->update([
            'hayon_id' => $request->hayon,
            'date_intervention' => $request->date_intervention,
            'user_id' => $request->user,
            'type_panne_id' => $request->type_panne_id,
            'status_id' => $request->status_id,
        ]);

        return redirect()->route('Intervention.list')->with('success', 'Intervention Modifier avec Succés');

    }

    /**
     * Update the specified resource in storage.
     */

    public function cancel(Request $request, $id)
    {

        try {
            $this->authorize('delete', Intervention::class);
            $request->validate([
                'observation' => 'required'
            ]);

            $inter = Intervention::whereId($id)->firstOrFail();
            $inter->delete();
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
     */
    public function destroy($id)
    {
        try {
            $this->authorize('delete', Intervention::class);

            $inter = Intervention::whereId($id)->firstOrFail();
            $inter->delete();
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
