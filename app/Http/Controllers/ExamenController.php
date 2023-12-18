<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @group Examen Management
 * API TO Manage Examen
 */
class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Examen::class);
        // $count = Question::where('status',true)->count();
        $examens = Examen::with('question')->get();

        return view('examen.index', compact('examens'));
    }

    public function create()
    {
        $this->authorize('create', Examen::class);

        return view('examen.create');
    }

    public function show($id)
    {
        $this->authorize('viewAny', Examen::class);
        $examen = Examen::whereId($id)->with('question')->firstOrFail();
        return view('examen.show', compact('examen'));
    }

    /**
     * Store a newly created resource in storage.
     * @bodyParam examen string
     * @bodyParam icon image base64
     *
     */
    public function store(Request $request)
    {

        $this->authorize('create', Examen::class);

        // $request->validate([
        //     'examen' => 'required'
        // ]);
        $path = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
        }
        Examen::create([
            'examen' => $request->examen,
            'icon' => $path
        ]);
        return redirect()->route('Examen.index')->with('Success', 'Examen Créer Avec Succés');
    }

    public function edit($id)
    {
        $this->authorize('update', Examen::class);

        $examen = Examen::whereId($id)->firstOrFail();
        return view('examen.edit', compact('examen'));
    }



    /**
     * Update the specified resource in storage.
     * @queryParam $id
     * @bodyParam examen string
     *
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Examen::class);

        $request->validate([
            'examen' => 'required',
        ]);

        $examen = Examen::findOrFail($id);

        $examen->examen = $request->examen;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
            $examen->icon = $path;
        }
        $examen->update();
        return redirect()->route('Examen.index')->with('success', 'Examen Modifer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete', Examen::class);

        $examen = Examen::findOrFail($id);
        $examen->delete();
        return redirect()->route('Examen.index')->with('success', 'Examen Modifer');
    }
    /**
     * Deleted resources from storage.
     */
    public function deleted()
    {
        $this->authorize('restore', Examen::class);
        $examens = Examen::onlyTrashed()->get();
        return view('examen.deleted', compact('examens'));
    }
    /**
     * Restore the specified resource from storage.
     */

    public function restore($id)
    {
        $this->authorize('restore', Examen::class);

        $examen = Examen::withTrashed()->whereId($id)->firstOrFail();
        $examen->restore();
        return redirect()->route('Examen.index')->with('success', 'Examen Restaurer');
    }
}
