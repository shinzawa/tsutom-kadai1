<?php

namespace App\Http\Controllers;

use Livewire\Component;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Livewire\Modal;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'content']);
        $categories = Category::all();
        return view('confirm', compact('contact', 'categories'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'content']);
        Contact::create($contact);
        return view('thanks');
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->KeywordSearch($request->keyword)
            ->GenderSearch($request->gender)
            ->CategorySearch($request->category_id)
            ->DateSearch($request->date)->get();
        $categories = Category::all();
        
        return view('liveware.modal', compact('contacts', 'categories'));
    }
}
