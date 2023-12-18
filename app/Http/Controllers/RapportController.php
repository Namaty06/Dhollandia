<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Intervention;
use App\Models\Question;
use App\Models\Rapport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @group Rapport Management
 * API TO Manage Rapport
 */
class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        try {
            $interv = Intervention::whereId($id)->firstOrFail();
            if ($interv->status_id == 1) {
                $config = Configuration::latest()->first();
                $rapport = Rapport::create([
                    'intervention_id' => $id
                ]);
                foreach ($request->answer as $answer) {
                    if ($answer[2] == 1) {
                        $rapport->answer()->attach($answer[1],['answer'=>1]);
                    } else {
                        $base64 = explode(",", $answer[3]);
                        $image = base64_decode($base64[1]);
                        $filename = time() . '.' . 'png';
                        Storage::put($filename, $image);
                        $rapport->answer()->attach($answer[1],['answer'=>1 , 'path'=>$filename]);

                    }
                }

                // $pdf = PDF::loadView('pdf', compact('rapport','config'));

                return response()->json([
                    'status' => true,
                    'message' => 'Successfuly'
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Status n est pas Encours'
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rapport $rapport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rapport $rapport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rapport $rapport)
    {
        //
    }
}
