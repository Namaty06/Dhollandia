<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Intervention;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    public function create($id)
    {
        $types = TypeDocument::all();
        $interv = Intervention::whereId($id)->first();
        return view('intervention.upload', compact('interv', 'types'));
    }

    public function store(Request $request, $id)
    {

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
        $interv = Intervention::whereId($id)->first();

        if ($request->pdfs) {
            $array = explode(",", $request->pdfs);
            for ($i = 1; $i < count($array); $i += 2) {
                $image = base64_decode($array[$i]);

                $filename = uniqid() . '.' . 'png';
                Storage::put('public/images/' . $filename, $image);

                $interv->document()->create([
                    'path' => $filename,
                    'type_document_id' => 3,
                ]);
            }
        }

        if ($request->file('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if ($file->getMimeType() != 'application/pdf') {

                    $filename = uniqid() . '.' . File::extension($file->getClientOriginalName());
                    Storage::put('public/images/' . $filename, $file);
                    $interv->document()->create([
                        'path' => $filename,
                        'type_document_id' => 3,
                    ]);
                }
            }
        }
    }
}
