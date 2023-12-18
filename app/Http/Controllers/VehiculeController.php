<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use App\Models\TypeDocument;
use App\Models\TypeVehicule;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @group Vehicule Management
 * API TO Manage  Vehicule
 */
class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource
     *
     */
    public function index()
    {
        $this->authorize('viewAny', Vehicule::class);
        $vehicules = Vehicule::with('status')->get();
        return view('vehicule.index', compact('vehicules'));
    }

    public function create()
    {
        $this->authorize('create', Vehicule::class);
        $types = TypeVehicule::all();
        return view('vehicule.create', compact('types'));
    }

    public function show($id)
    {
        $this->authorize('viewAny', Vehicule::class);
        $types = TypeDocument::all();
        $vehicule = Vehicule::whereId($id)->with('status','typevehicule')->first();
        return view('vehicule.show',compact('vehicule','types'));
    }


    /**
     * Store a newly created resource in storage.
     * @bodyParam numero_serie  unique required
     * @bodyParam matricule  unique
     * @bodyParam type_id typevehicule
     * @bodyParam date_circulation date
     * @bodyParam marque string
     * @bodyParam capacite double
     * @bodyParam image base64
     */
    public function store(Request $request)
    {
        $this->authorize('create', Vehicule::class);

        $request->validate([
            'numero_serie' => 'required|unique:vehicules,numero_serie',
            'matricule' => 'nullable|unique:vehicules,matricule',
            'typevehicule' => 'nullable|exists:type_vehicules,id',
            'dmc' => 'nullable|date',
            'pdf'=> 'nullable|mimes:pdf'
            // 'image' => 'nullable|mimes:jpeg,png,jpg'
        ]);

        $path = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
        }
        $file ='';

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');

            $file = $pdf->store('files', 'public');
        }

        Vehicule::create([
            'numero_serie' => $request->numero_serie,
            'typevehicule_id' => $request->typevehicule,
            'matricule' => $request->matricule,
            'marque' => $request->marque,
            'date_circulation' => $request->dmc,
            'capacite' => $request->capacite,
            'image' => $path,
            'pdf'=>$file,
            'status_id'=>5
        ]);

        return redirect()->route('Vehicule.index')->with('success', 'Vehicule Créer avec Succés');
    }

    public function edit($id)
    {

        $this->authorize('update', Vehicule::class);
        $vehicule = Vehicule::whereId($id)->first();
        $types = TypeVehicule::all();
        return view('vehicule.edit', compact('vehicule', 'types'));
    }

    public function view(Request $request, $id){

        
    }

    public function upload(Request $request, $id){


    }


    /**
     * Update the specified resource in storage.
     * @queryParam id int
     * @bodyParam numero_serie  unique required
     * @bodyParam matricule  unique
     * @bodyParam type_id typevehicule
     * @bodyParam date_circulation date
     * @bodyParam marque string
     * @bodyParam poid string
     * @bodyParam image base64
     * @bodyParam status bool
     *
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Vehicule::class);

        $request->validate([
            'numero_serie' => 'required|unique:vehicules,numero_serie,' . $id,
            'matricule' => 'nullable|unique:vehicules,matricule,' . $id,
            'typevehicule' => 'nullable|exists:type_vehicules,id',
            'dmc' => 'nullable|date',
            'pdf'=> 'nullable|mimes:pdf'
        ]);
        $vehicule = Vehicule::whereId($id)->firstOrFail();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
        } else {
            $path = $vehicule->image;
        }
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $file = $pdf->store('files', 'public');
        } else {
            $file = $vehicule->pdf;
        }
        $vehicule->numero_serie = $request->numero_serie;
        $vehicule->typevehicule_id = $request->typevehicule;
        $vehicule->matricule = $request->matricule;
        $vehicule->marque = $request->marque;
        $vehicule->date_circulation = $request->dmc;
        $vehicule->capacite = $request->capacite;
        $vehicule->image = $path;
        $vehicule->pdf = $file;

        $vehicule->update();

        return redirect()->route('Vehicule.index')->with('success', 'Vehicule Modifier avec Succés');
    }

    /**
     * Remove the specified resource from storage.
     * @queryParam id int

     */
    public function destroy($id)
    {
        $this->authorize('delete', Vehicule::class);
        $vehicule = Vehicule::whereId($id)->firstOrFail();
        if ($vehicule->status == 1) {
            return redirect()->route('Vehicule.index')->with('error', 'Vehicule en Travaille');
        } else {
            $vehicule->delete();
            return redirect()->route('Vehicule.index')->with('success', 'Vehicule Supprimer avec Succés');
        }
    }

    public function getvehicule($id)
    {
        $societes = Societe::whereId($id)->with('contrat.vehicule')->first();
        $vehicules=[];
        foreach($societes->contrat as $contrat){
            array_push($vehicules,$contrat->vehicule);
        }
        return response()->json($vehicules);
    }
    /**
     * List of Deleted resources
     */
    public function deleted()
    {
        $this->authorize('restore', Vehicule::class);
        $vehicules = Vehicule::onlyTrashed()->get();
        return view('vehicule.deleted', compact('vehicules'));
    }

    /**
     * Restore the specified resource
     * @queryParam id int
     */

    public function restore($id)
    {
        $this->authorize('restore', Vehicule::class);
        $vehicule = Vehicule::withTrashed()->whereId($id)->firstOrFail();
        $vehicule->restore();
        return redirect()->route('Vehicule.index')->with('success', 'Vehicule Restaurer avec Succés');
    }

    // public function upload(Request $request, $id)
    // {
    //     try {
    //         $validate = Validator::make(
    //             $request->all(),
    //             [
    //                 'img' => 'required'
    //             ]
    //         );

    //         if ($validate->fails()) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'validation error',
    //                 'errors' => $validate->errors()
    //             ], 401);
    //         }
    //         $meet = Meeting::whereId($id)->with('dossier')->firstOrFail();
    //         if ($meet->meeting_status_id != 2) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Meeting est deja Cloturer ou Reporter'
    //             ], 401);
    //         }
    //         if (Auth::user()->id != $meet->user_id) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Meeting Not for you'
    //             ], 401);
    //         }
    //         $dossier = Dossier::whereId($meet->dossier->id)->first();
    //         if ($meet->type == 2) {
    //             $type = TypeDocument::whereId(5)->first();
    //             $body = "A Ajouter Photo Expertise Avant  :" . $meet->dossier->ref;
    //             $devis = Devis::where('dossier_id', $dossier->id)->where('devis_status_id', 9)->get();
    //             $devicount = count($devis);
    //             if ($devicount > 0) {
    //                 $status = DevisStatus::whereId(4)->first();
    //                 foreach ($devis as $d) {
    //                     $d->devis_status_id = $status->id;
    //                     $d->update();
    //                     $d->devisstatus()->attach($status, ['user_id' => Auth::user()->id]);
    //                 }
    //             }
    //         }
    //         if ($meet->type == 5) {
    //             $type = TypeDocument::whereId(7)->first();
    //             $body = "A Ajouter Photo Expertise En Cours:" . $meet->dossier->ref;
    //         }
    //         if ($meet->type == 10) {
    //             $type = TypeDocument::whereId(6)->first();
    //             $body = "A Ajouter Photo Expertise Aprés :" . $meet->dossier->ref;
    //             $facture = Facture::where('dossier_id', $dossier->id)->where('devis_status_id', 9)->get();
    //             $facturecount = count($facture);
    //             if ($facturecount > 0) {
    //                 $status = DevisStatus::whereId(4)->first();
    //                 foreach ($facture as $f) {
    //                     $f->devis_status_id = $status->id;
    //                     $f->update();
    //                     $f->facturestatus()->attach($status, ['user_id' => Auth::user()->id]);
    //                 }
    //             }
    //         }

    //         DB::beginTransaction();
            // try {
            //     $array = explode(",", $request->img);
            //     foreach ($array as $key) {
            //         $image = base64_decode($key);
            //         $filename = uniqid() . '.' . 'png';
            //         Storage::disk('s3')->put('documents/' . $dossier->ref . '/' . $type->type . '/' . $filename, $image);
            //         $path = 'documents/' . $dossier->ref . '/' . $type->type . '/' . $filename;

            //         Document::create([
            //             'path' => $path,
            //             'dossier_id' => $dossier->id,
            //             'type_document_id' => $type->id
            //         ]);
            //     }

            //     DB::commit();
            // } catch (\Exception $ex) {
            //     DB::rollback();
            //     return response()->json(['error' => $ex->getMessage()], 500);
            // }
            // return response()->json([
    //             'status' => true,
    //             'message' => 'success'
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }

}
