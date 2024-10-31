<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    function contact(){
     return view('customer.contact.contact');
    }
    function contactsent(Request $req){
        $req->validate([
'title'=>'required',
'message'=>'required'
        ]);
        Contact::create([
            'user_id'=>$req->userid,
        'title'=>$req->title,
        'message'=>$req->message
        ]);
        Alert::success('message sent','message successfully sent');
        return back();


    }
}
