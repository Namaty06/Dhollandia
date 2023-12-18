<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * @group Question Management
 * API TO Manage Question
 */

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @bodyParam question string
     * @bodyParam examen_id
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'examen' => 'required|exists:examens,id'
        ]);
        Question::create([
            'question' => $request->question,
            'examen_id' => $request->examen,
            'status' => 1
        ]);
        return redirect()->back()->with('success', 'Question Créer avec Succés');
    }

    public function edit($id)
    {

        $question = Question::findOrFail($id);
        return view('question.edit', compact('question'));
    }


    /**
     * Update the specified resource in storage.
     * @queryParam $id
     * @bodyParam question string
     * @bodyParam examen_id
     * @bodyParam status boolean
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'question' => 'required',
        ]);
        $question = Question::findOrFail($id);
        $question->question = $request->question;
        $question->update();

        return redirect()->route('Examen.show', $question->examen_id)->with('success', 'Question Modifier avec Succés');
    }

    /**
     * Remove the specified resource from storage.
     *  @queryParam $id
     */
    public function destroy($id)
    {

            $question = Question::findOrFail($id);
            $question->delete();

            return redirect()->route('Examen.index')->with('success', 'Question Supprimer avec Succés');

    }


    /**
     * Remove the specified resource from storage.
     *  @queryParam $id
     */
    public function deleted()
    {
        $questions = Question::onlyTrashed()->get();
        return view('question.deleted', compact('questions'));
    }

    /**
     * Restore the specified resource from storage.
     *  @queryParam $id
     */
    public function restore($id)
    {
        $question = Question::withTrashed()->whereId($id)->firstOrFail();
        $question->restore();
        return redirect()->route('Examen.index')->with('success', 'Question Restaurer avec Succés');
    }


}
