<?php

namespace App\Http\Controllers\Web\Contact;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.contact.index');
    }

    public function store(Request $request)
    {
        $contact = new Contact();
        $contact->fill($request->toArray());
        $contact->save();
        return ['success'=>true];
    }

    public function aboutUs()
    {
        return view('web.contact.about_us');
    }
}
