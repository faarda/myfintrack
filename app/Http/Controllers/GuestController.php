<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class GuestController extends Controller
{
    public function contactForm()
    {
    	return view('contact');
    }

    public function contact(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|string',
    		'email' => 'required|email',
    		'message' => 'required|string|max:3000'
    	]);

    	$contact = Contact::create($request->only('name', 'email', 'message'));

    	return back()->with('status', "Thanks for contacting us, we would reach out to you shortly!");
    }
}
