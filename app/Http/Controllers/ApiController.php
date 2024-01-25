<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contrat;
use App\Models\Document;
use App\Models\Examen;
use App\Models\Intervention;
use App\Models\Piece;
use App\Models\Rapport;
use App\Models\Reclamation;
use App\Models\User;
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
        $interventions = Intervention::whereYear('date_intervention', $year)->whereHasMorph('interventionable', Contrat::class)->with('user','interventionable.societe','interventionable.vehicule','interventionable.status','typepanne')->get();
        return response()->json($interventions);
    }

    public function list()
    {
        try{
            $intervs = Intervention::with('user','interventionable.societe','interventionable.vehicule','interventionable.status','typepanne')->latest()->get();

            return response()->json($intervs);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

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
                'bontravail'=>'required'
            ]);


            $inter = Intervention::whereId($id)->firstOrFail();
            if ($inter->status_id != 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Intervention n est pas encours '
                ], 401);
            }

            $inter->status_id = 2;
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
                    $inter->document()->create([
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


            $rapport = Rapport::create([
                'ref'=>'R'. date('m') . date('Y'),
                'intervention_id' => $id,
            ]);
            $pdf = Pdf::loadView('pdf', compact('inter', 'rapport'));
            $filename = time() . '.' . 'pdf';
            Storage::put('public/images/' . $filename, $pdf->output());
            $rapport->path = $filename;
            $rapport->update();
            $inter->update();


            $contacts = Contact::where('societe_id',$inter->interventionable->societe_id)->get();

            foreach ($contacts as $contact) {

                $path = "https://beta.msinvestsav.com/storage/images/1700836982.pdf";
                Mail::send('mail', ['intervention' => $inter], function ($message) use ($inter,$contact, $path) {
                    $message->to($contact->email);
                    $message->subject("test");
                    $message->attach($path, [
                        'as' => 'attachment.pdf', // Set the name of the attached file
                        'mime' => 'application/pdf', // Set the MIME type of the attached file
                    ]);
                });
            }

            return response()->json([
                'status' => true,
                'message' =>"Succés"
            ], 200);
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
                'bontravail'=>'required'
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

                    $inter->document()->create([
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
                $inter->document()->create([
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

            if ($request->has('pieces')) {
                foreach($request->pieces as $piece){
                    Piece::create([
                        'intervention_id'=>$inter->id,
                        'piece' => $piece['piece'], // Accessing 'piece' as an array element
                        'qte' => $piece['qte'], 
                    ]);
                }
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

    public function updatetoken(Request $request)
    {
        try {
            $user = User::whereId(Auth::user()->id)->first();
            $user->fcm_token = $request->token;
            $user->update();
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
