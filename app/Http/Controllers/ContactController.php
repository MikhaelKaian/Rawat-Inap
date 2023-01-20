<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Contact;
use App\Mail\ContactMe;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function send ()
    {
        request()->validate(['email' => 'required|email']);

        Mail::to(request('email'))->send(new ContactMe());
        return redirect()->back();
    }
}
