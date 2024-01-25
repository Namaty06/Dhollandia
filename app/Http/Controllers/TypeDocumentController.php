<?php

namespace App\Http\Controllers;

use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', TypeDocument::class);

        $types = TypeDocument::all();
        return view('TypeDocument.index', compact('types'));
    }


    public function create()
    {
        // $this->authorize('create', TypeDocument::class);

        return view('TypeDocument.create');
    }
    /**
     * Store a newly created resource in storage.
     *  @bodyParam type string  required unique
     */
    public function store(Request $request)
    {

        // $this->authorize('create', TypeDocument::class);

        $request->validate([
            'type' => 'required|unique:type_documents,type'
        ]);
        TypeDocument::create([
            'type' => $request->type
        ]);
        return redirect()->route('TypeDocument.index')->with('success', 'Type Créer avec Succés');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        // $this->authorize('update', TypeDocument::class);

        $type = TypeDocument::whereId($id)->first();
        return view('TypeDocument.edit', compact('type'));
    }


    /**
     * Update the specified resource in storage.
     * @queryParam id int
     *  @bodyParam type string  required unique
     */
    public function update(Request $request, $id)
    {
        // $this->authorize('update', TypeDocument::class);

        $request->validate([
            'type' => 'required|unique:type_pannes,type,' . $id
        ]);
        $type = TypeDocument::whereId($id)->firstOrFail();
        $type->type = $request->type;
        $type->update();

        return redirect()->route('TypeDocument.index')->with('success', 'Type Modifier avec Succés');
    }

    /**
     * Remove the specified resource from storage.
     * @queryParam id int
     */
    public function destroy($id)
    {
        // $this->authorize('delete', TypeDocument::class);

        $type = TypeDocument::whereId($id)->firstOrFail();
        $type->delete();
        return redirect()->route('TypeDocument.index')->with('success', 'Type Supprimer avec Succés');
    }
    /**
     * List of deleted resources
     */
    public function deleted()
    {
        // $this->authorize('restore', TypeDocument::class);
        $types = TypeDocument::onlyTrashed()->get();
        return view('TypeDocument.deleted', compact('types'));
    }
    /**
     * Restore the specified resource from storage.
     * @queryParam id int
     */
    public function restore($id)
    {
        // $this->authorize('restore', TypeDocument::class);

        $type = TypeDocument::withTrashed()->whereId($id)->firstOrFail();
        $type->restore();
        return redirect()->route('TypeDocument.index')->with('success', 'Type Restaurer avec Succés');
    }
}
