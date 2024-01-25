<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Societe;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{


    public function create($id)
    {
        $societe = Societe::whereId($id)->with('contact')->first();
        return view('contact.create',compact('societe'));

    }

    public function store(Request $request)
    {
        $societe = Societe::whereId($request->societe_id)->first();
        $request->validate([
            'name'=>'required',
            'email'=>'email|required|unique:contacts,email',
            'tel'=>'min:9|nullable'
        ]);

        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'tel'=>$request->tel,
            'societe_id'=>$societe->id
        ]);

        return redirect()->route('Societe.show',$societe->id)->with('success','Contact Creer avec Succés');

    }

    public function edit($id)
    {
        $contact = Contact::whereId($id)->with('societe')->first();
        return view('contact.edit',compact('contact'));

    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'email|required|unique:contacts,email,'.$id,
            'tel'=>'min:9|nullable'
        ]);
        $contact = Contact::whereId($id)->with('societe')->first();
        $contact->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'tel'=>$request->tel,
        ]);

        return redirect()->route('Societe.show',$contact->societe->id)->with('success','Contact Modifier avec Succés');
    }

    public function destroy($id)
    {
        $contact = Contact::whereId($id)->with('societe')->first();
        $contact->delete();
        return redirect()->back()->with('success','Contact Supprimer avec Succés');

    }

    public function deleted($id)
    {
        $contacts = Contact::where('societe_id',$id)->onlyTrashed()->get();
        return view('contact.deleted',compact('contacts'));

    }


    public function restore($id)
    {
        $contact = Contact::whereId($id)->withTrashed()->first();
        $contact->restore();
        return redirect()->back()->with('success','Contact Restaurer avec Succés');

    }


}
