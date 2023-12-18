<?php

namespace App\Http\Controllers;

use App\Mail\SendRapport;
use App\Models\Contrat;
use App\Models\Examen;
use App\Models\Intervention;
use App\Models\Rapport;
use App\Models\Reclamation;
use App\Models\TypeDocument;
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
            ->with('status', 'contrat.vehicule.typevehicule', 'contrat.societe', 'contrat',)
            ->get();

        return response()->json($interventions);
    }



    public function show($id)
    {

        $intervention = Intervention::whereId($id)->with('document.typedocument')->whereHasMorph('interventionable', Reclamation::class)->first();

        // Retrieve interventions where the morphed relationship is a Contract and meets the condition
        $interventionsContract = Intervention::whereId($id)->whereHasMorph('interventionable', Contrat::class)->first();

        if($intervention){
            $typedocuments = TypeDocument::all();
            // dd($intervention);
            return view('intervention.showRec', compact('intervention','typedocuments'));
        }
        if($interventionsContract){
            return view('intervention.show', compact('interventionsContract'));
        }
        // $intervention = Intervention::whereId($id)
        //     ->with('status', 'contrat.vehicule.typevehicule', 'contrat.societe', 'contrat', 'rapport')->firstOrFail();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Intervention::create([
                'date_intervention' => $request->date_intervention,
                'contrat_id' => $request->contrat_id,
                'status_id' => 1
            ]);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
                'date' => 'required'
            ]);


            $inter = Intervention::whereId($id)->firstOrFail();
            if ($inter->status_id != 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Intervention n est pas encours '
                ], 401);
            }

            // $inter->status_id = 2;
            $inter->date_validation = $request->date;
            $inter->lat = $request->lat;
            $inter->lng = $request->lng;
            $inter->user_id = Auth::user()->id;
            $inter->update();

            foreach ($request->answer as $answer) {

                if ($answer[1]) {
                    $inter->question()->attach($answer[0], [
                        'answer' => 1
                    ]);
                } else {

                    // $base64 = explode(",", $answer[2]);
                    $image = base64_decode($answer[2]);
                    $filename = time() . '.' . 'png';
                    Storage::put('public/images/' . $filename, $image);

                    $inter->question()->attach($answer[0], [
                        'observation' => $answer[3],
                        'answer' => 0,
                        'path' => $filename,
                    ]);
                }
            }
            $intervention = Intervention::whereId($id)->with('question.examen', 'contrat.vehicule', 'status')->firstOrFail();
            $rapport = Rapport::create([
                'intervention_id' => $id,
            ]);

            $rapport->ref = 'R' . $rapport->id . date('m') . date('Y');
            $rapport->update();
            $pdf = DomPDFPDF::loadView('pdf', compact('intervention', 'rapport'));
            $filename = time() . '.' . 'pdf';
            Storage::put('public/images/' . $filename, $pdf->output());
            $rapport->path = $filename;
            $rapport->update();



            return response()->json([
                "path" => $filename
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
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
