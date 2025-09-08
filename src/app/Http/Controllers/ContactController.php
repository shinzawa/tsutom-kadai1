<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function confirm(Request $request)
    {
        $contact = $request->only(['last_name', 'first_name','gender', 'email', 'tel1','tel2','tel3', 'address', 'building','category', 'content']);
        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        $contact = $request->only(['last_name', 'first_name','gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category', 'content']);
        // Contact::create($contact);
        return view('thanks');
    }
}
