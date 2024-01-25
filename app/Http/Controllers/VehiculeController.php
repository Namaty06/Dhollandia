<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Societe;
use App\Models\TypeDocument;
use App\Models\TypeVehicule;
use App\Models\Vehicule;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $vehicules = Vehicule::with('status', 'ville', 'societe')->get();
        return view('vehicule.index', compact('vehicules'));
    }

    public function create()
    {
        $this->authorize('create', Vehicule::class);
        $types = TypeVehicule::all();
        $villes = Ville::all();
        $societes = Societe::all();
        return view('vehicule.create', compact('types', 'villes', 'societes'));
    }


    public function show($id)
    {
        $this->authorize('viewAny', Vehicule::class);
        $typedocuments  = TypeDocument::all();
        $vehicule = Vehicule::whereId($id)->with('status', 'typevehicule', 'societe', 'hayon')->first();

        return view('vehicule.show', compact('vehicule', 'typedocuments'));
    }

    public function detach(Request $request,$id)
    {
        $this->authorize('create', Contrat::class);

        $vehicule = Vehicule::whereId($id)->firstOrFail();
        $contrat = Contrat::whereId($request->contrat_id)->firstOrFail();
        $vehicule->contrats()->detach($contrat);

        return redirect()->back()->with('success', 'Vehicule a été Detacher du Contrat avec Succés');
    }


    public function attach(Request $request)
    {
        $this->authorize('create', Contrat::class);

        $vehicule = Vehicule::whereId($request->vehicule_id)->firstOrFail();
        $contrat = Contrat::whereId($request->contrat_id)->firstOrFail();
        if($vehicule->societe_id != $contrat->societe_id){
            return redirect()->back()->with('success', 'la vehicule et contrat ont pas le meme client');
        }
        $vehicule->contrats()->attach($contrat);

        return redirect()->back()->with('success', 'Vehicule a été Detacher du Contrat avec Succés');
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
            'matricule' => 'nullable|unique:vehicules,matricule',
            'typevehicule' => 'nullable|exists:type_vehicules,id',
            'societe' => 'nullable|exists:societes,id',
            'ville' => 'required'
        ]);



        Vehicule::create([
            // 'numero_serie' => $request->numero_serie,
            'typevehicule_id' => $request->typevehicule,
            'matricule' => $request->matricule,
            // 'marque' => $request->marque,
            // 'date_circulation' => $request->dmc,
            // 'capacite' => $request->capacite,
            'societe_id' => $request->societe,
            'ville_id' => $request->ville,
            // 'image' => $path,
            'status_id' => 5
        ]);

        return redirect()->route('Vehicule.index')->with('success', 'Vehicule Créer avec Succés');
    }

    public function edit($id)
    {

        $this->authorize('update', Vehicule::class);
        $vehicule = Vehicule::whereId($id)->first();
        $types = TypeVehicule::all();
        $villes = Ville::all();
        $societes = Societe::all();

        return view('vehicule.edit', compact('vehicule', 'types', 'societes', 'villes'));
    }

    public function view(Request $request, $id)
    {

    }

    public function upload(Request $request, $id)
    {
        $this->authorize('update', Vehicule::class);

        $request->validate([
            'type' => 'required'
        ]);
        $vehicule = Vehicule::whereId($id)->first();
        $type = TypeDocument::whereId($request->type)->first();



        $validator = Validator::make(
            $request->all(),
            [
                'type' => 'required',
                'files' => 'required',
                'files.*' => 'mimes:jpg,jpeg,png,pdf|required'
            ],
            [
                'files.*.required' => 'Ce champ est Obligatoire',
                'files.*.mimes' => 'Only jpg,jpeg,png,pdf are allowed',
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        if ($request->pdfs) {
            $array = explode(",", $request->pdfs);
            for ($i = 1; $i < count($array); $i += 2) {
                $image = base64_decode($array[$i]);

                $filename = uniqid() . '.' . 'png';
                Storage::put('public/images/' . $filename, $image);

                $vehicule->document()->create([
                    'type_document_id' => $type->id,
                    'path' => $filename
                ]);
            }
        }

        if ($request->file('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if ($file->getMimeType() != 'application/pdf') {

                    $filename = uniqid() . '.' . File::extension($file->getClientOriginalName());
                    Storage::put('public/images/' . $filename, $file);
                    $vehicule->document()->create([
                        'type_document_id' => $type->id,
                        'path' => $filename
                    ]);
                }
            }
        }
        return redirect()->route('Vehicule.index')->with('success', 'Vehicule Modifier');
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
            'matricule' => 'nullable|unique:vehicules,matricule,' . $id,
            'typevehicule' => 'nullable|exists:type_vehicules,id',
            'ville' => 'required',
            'societe' => 'nullable|exists:societes,id',

        ]);
        $vehicule = Vehicule::whereId($id)->firstOrFail();
        $vehicule->typevehicule_id = $request->typevehicule;
        $vehicule->matricule = $request->matricule;
        $vehicule->ville_id = $request->ville;
        $vehicule->societe_id = $request->societe;
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
        $vehicule->delete();
         return redirect()->route('Vehicule.index')->with('success', 'Vehicule Supprimer avec Succés');

    }

    public function getvehicule($id)
    {
        $societes = Societe::whereId($id)->with('contrat', function ($query) {
            $query->where('status_id', 1);
        })->first();

        $vehicules = [];
        foreach ($societes->contrat as $contrat) {
            array_push($vehicules, $contrat->vehicule);
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
