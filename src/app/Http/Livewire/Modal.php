<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Livewire\WithPagination;

class Modal extends Component
{
    use WithPagination;


    public $showModal = false;

    protected $paginationTheme = 'bootstrap';

    public $contact;


    public function render()
    {
        // $contacts = Contact::with('category')
        //     ->paginate(7);
        // $contacts = Contact::with('category');
        // $categories = Category::all();

        return view('livewire.modal', ['contacts' => Contact::with('category')->paginate(7)]);
    }


    public function openModal($id)
    {
        $this->contact = Contact::with('category')->find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
