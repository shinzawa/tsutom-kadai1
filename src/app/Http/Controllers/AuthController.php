<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        return view('index');
    }

    public function admin()
    {
        $contacts = Contact::with('category')
                    ->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
