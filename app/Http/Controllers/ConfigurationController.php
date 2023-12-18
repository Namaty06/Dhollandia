<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $this->authorize('viewAny',Configuration::class);
            $config = Configuration::latest()->first();
            return response()->json($config);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @bodyParam name string required
     * @bodyParam email email required
     * @bodyParam logo base64 required
     * @bodyParam background string
     * @bodyParam color string
     *
     */
    public function store(Request $request)
    {

        try {

            $this->authorize('create',Configuration::class);

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'logo' => 'required'
            ]);
            $base64 = explode(",", $request->logo);
            $image = base64_decode($base64[1]);
            $filename = 'images/'.time() . '.' . 'png';
            Storage::put('public/'.$filename, $image);

            Configuration::create([
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $filename,
                'background' => $request->background,
                'color' => $request->color
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
     * @queryParam id int
     * @bodyParam name string required
     * @bodyParam email email required
     * @bodyParam logo base64 required
     * @bodyParam background string
     * @bodyParam color string
     */
    public function update(Request $request, $id)
    {
        try {

            $this->authorize('update',Configuration::class);

            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
            $config = Configuration::whereId($id)->firstOrFail();
            if ($request->logo) {
                $base64 = explode(",", $request->logo);
                $image = base64_decode($base64[1]);
                $filename = 'images/'.time() . '.' . 'png';
                Storage::put('public/'.$filename, $image);
                $config->logo = $filename;
            }
            $config->name = $request->name;
            $config->email = $request->email;
            $config->background = $request->background;
            $config->color = $request->color;
            $config->update();

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
     *
     */
    public function destroy($id)
    {
        try {

            $this->authorize('delete',Configuration::class);
            $config = Configuration::whereId($id)->firstOrFail();
            $config->delete();
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
     * List of deleted resources from storage.
     */
    public function deleted()
    {
        try {
            $this->authorize('restore',Configuration::class);

            $config = Configuration::onlyTrashed()->get();
            return response()->json($config);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Restore the specified resource from storage.
     * @queryParam id int
     *
     */
    public function restore($id)
    {
        try {
            $this->authorize('restore',Configuration::class);

            $config = Configuration::withTrashed()->whereId($id)->firstOrFail();
            $config->restore();
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
