<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Examen;
use App\Models\Intervention;
use App\Models\Rapport;
use App\Models\Reclamation;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function intervention($year)
    {

        if (empty($year)) {
            $year = Carbon::now()->format('Y');
        }
        $interventions = Intervention::whereYear('date_intervention', $year)->with('status', 'contrat.vehicule.typevehicule', 'contrat.societe', 'rapport')->get();
        return response()->json($interventions);
    }

    public function examens()
    {
        $examens = Examen::with('question')->get();
        return response()->json($examens);
    }

    public function updateContrat(Request $request, $id)
    {
        try {

            $request->validate([
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
                // 'date'=>'required'
            ]);


            $inter = Intervention::whereId($id)->firstOrFail();
            if ($inter->status_id != 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Intervention n est pas encours '
                ], 401);
            }

            //  $inter->status_id = 2;
            $inter->date_validation = now();
            $inter->lat = $request->lat;
            $inter->lng = $request->lng;
            $inter->user_id = Auth::user()->id;


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
                    Document::create([
                        'type_document_id' => 1,
                        'path' => $filename,
                        'intervention_id' => $inter->id
                    ]);

                    $inter->question()->attach($answer[0], [
                        'observation' => $answer[3],
                        'answer' => 0,
                        'path' => $filename,
                    ]);
                }
            }
            $inter->update();

            $rapport = Rapport::create([
                'intervention_id' => $id,
            ]);

            $rapport->ref = 'R' . $rapport->id . date('m') . date('Y');
            $rapport->update();
            $pdf = Pdf::loadView('pdf', compact('inter', 'rapport'));

            $filename = time() . '.' . 'pdf';
            Storage::put('public/images/' . $filename, $pdf->output());
            $rapport->path = $filename;
            $rapport->update();
            $path = "https://beta.msinvestsav.com/storage/images/1700836982.pdf";
            Mail::send('mail', ['intervention' => $inter], function ($message) use ($inter, $path) {
                $message->to("namaty06@gmail.com");
                $message->subject("test");
                $message->attach($path, [
                    'as' => 'attachment.pdf', // Set the name of the attached file
                    'mime' => 'application/pdf', // Set the MIME type of the attached file
                ]);
            });
            return $pdf->download("pdf");
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function updateRec(Request $request, $id)
    {
        try {

            $request->validate([
                'lat' => 'required|numeric',
                'lng' => 'required|numeric',
            ]);


            $inter = Intervention::whereId($id)->firstOrFail();
            if ($inter->status_id != 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Intervention n est pas encours '
                ], 401);
            }

            if ($request->has('images')) {
                foreach ($request->images as $image) {

                    $image = base64_decode($image);
                    $filename = time() . '.' . 'png';
                    Storage::put('public/images/' . $filename, $image);

                    Document::create([
                        'type_document_id' => 1,
                        'path' => $filename,
                        'intervention_id' => $inter->id
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Photo avant sont Obligatoire '
                ], 401);
            }

            if ($request->has('ordre_mission')) {
                $ordre_mission = base64_decode($request->ordre_mission);
                $filename = time() . '.' . 'png';
                Storage::put('public/images/' . $filename, $ordre_mission);
                Document::create([
                    'type_document_id' => 2,
                    'path' => $filename,
                    'intervention_id' => $inter->id
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Ordre Mission est Obligatoire '
                ], 401);
            }

            $inter->date_validation = now();
            $inter->status_id = 2;
            $inter->lat = $request->lat;
            $inter->lng = $request->lng;
            $inter->user_id = Auth::user()->id;
            $inter->update();
            $reclam = Reclamation::whereId( $inter->interventionable->id)->first();
            $reclam->status_id = 2;
            $reclam->update();
            return response()->json([
                'status' => true,
                'message' => 'Success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
