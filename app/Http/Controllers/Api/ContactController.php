<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\NewContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request){

        $data = $request->all();
        $success = true;

        $validator = Validator::make($data,[
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required',
        ],[
            'name.required' => 'Il nome è un campo obbligatorio',
            'name.max' => 'Sono consentiti al massimo :max caratteri',
            'email.required' => 'L\'email è un campo obbligatorio',
            'email.max' => 'Sono consentiti al massimo :max caratteri',
            'message.required' => 'Il messaggio è un campo obbligatorio',
        ]);

        // se esistono erroro li stampo nel json
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $new_contact = new Contact();
        $new_contact->fill($data);
        $new_contact->save();

        Mail::to('info@boolpress.com')->send(new NewContactMail($new_contact));


        return response()->json(compact('success'));

    }
}
