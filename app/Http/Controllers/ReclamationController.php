<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Intervention;
use App\Models\Reclamation;
use App\Models\Societe;
use App\Models\TypePanne;
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

        // $interventions = Intervention::whereHasMorph('interventionable', Reclamation::class)->with('interventionable')->get();
        // // Retrieve interventions where the morphed relationship is a Contract and meets the condition
        // $interventionsContract = Intervention::whereHasMorph('interventionable', Contrat::class)->with('interventionable')->get();
        // dd($interventions,$interventionsContract);
        $reclamations = Reclamation::with('societe','user','vehicule')->latest()->get();

        return view('reclamation.index',compact('reclamations'));
    }


    public function create()
    {
        $this->authorize('create', Reclamation::class);
        $vehicules = Vehicule::all();
        $societes = Societe::all();
        $users = User::all();
        $types = TypePanne::all();
        $nosvehicule = Vehicule::where('typevehicule_id',1)->get();

        return view('reclamation.create',compact('users','societes','vehicules','types','nosvehicule'));

    }
    /**
     * Store a newly created resource in storage.
     *  @bodyParam type string  required unique
     */
    public function store(Request $request)
    {

        $this->authorize('create', Reclamation::class);

        $request->validate([
            'vehicule_id'=>'required',
            'societe_id'=>'required',
            'user_id'=>'required',
            'type_panne_id'=>'required|exists:type_pannes,id',
            // 'bontravail'=>'nullable|exists:interventions,bon_travail',
            'transport_id'=>'nullable'
        ]);
        $currentDateTime = Carbon::now();
        $count = 1;
        $ref = "REC".$count.'/'.$currentDateTime->month.'/'.$currentDateTime->year;
        $reclamation = Reclamation::create([
            'vehicule_id'=>$request->vehicule_id,
            'societe_id'=>$request->societe_id,
            'user_id'=>$request->user_id,
            'ref'=>$ref,
            'status_id'=>1,
            'transport_id'=>$request->transport_id,
        ]);
        $reclamation->interventions()->create([
            'status_id'=>1,
            'date_intervention'=>now(),
            'type_panne_id'=>$request->type_panne_id,
            'bon_travail'=>$request->bontravail
        ]);

        // $url = 'https://fcm.googleapis.com/fcm/send';

        // $user = User::whereId($reclamation->user_id)->first();

        // $token = [$user->fcm_token];

        // $notif ="Reclamation Affecté : ".$reclamation->ref;

        // $serverKey = 'AAAANCX6iT8:APA91bFYyrHReMJwPhAETNPgwYTZPt_s0sfpZWWvtIroQ1k4GmvQ9US8MDLF4Qp0YSXqSNo7hGtv0ozhni_-D7OoY6g7so6mgJXr6qhJZ3axZsBSAjEyiASo5ON6f5IGj7TomMEQH4da';

        // $data = [
        //     "registration_ids" =>$token,
        //     "notification" => [
        //         "title" => "Reclamation Affecté ✅",
        //         "body" => $notif,
        //         "android_channel_id" => "nouveau_mreclamation",
        //         "notification_priority" => "PRIORITY_HIGH",
        //         "visibility" => "PUBLIC"
        //     ]
        // ];
        // $encodedData = json_encode($data);

        // $headers = [
        //     'Authorization:key=' . $serverKey,
        //     'Content-Type: application/json',
        // ];

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // // Disabling SSL Certificate support temporarly
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // // Execute post
        // $result = curl_exec($ch);
        // dd($result);
        // //Bon de travail
        // if ($result === FALSE) {
        //     die('Curl failed: ' . curl_error($ch));
        // }
        // // Close connection
        // curl_close($ch);

        return redirect()->route('home')->with('success','Reclamation Créer avec Succés');

    }

    public function show($id)
    {
        $this->authorize('viewAny', Reclamation::class);

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
