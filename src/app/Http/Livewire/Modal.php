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

    public $keyword = '';
    public $gender = '';
    public $category_id = '';
    public $date = '';
    public $selectedContact;

    public function search() {
        $this->resetPage(); /* 再レンダリング*/
    }

    public function resetSearch() {
        $this->keyword = '';
        $this->gender = '';
        $this->category_id = '';
        $this->date = '';
        $this->resetPage();
    }
    public function render()
    {
        $contacts = Contact::with('category')
            ->KeywordSearch($this->keyword)
            ->GenderSearch($this->gender)
            ->CategorySearch($this->category_id)
            ->DateSearch($this->date)->paginate(7);

        $categories = Category::all();

        return view('livewire.modal', [
            'contacts' => $contacts,
            'categories' => $categories
        ]);
    }

    public function openModal($id)
    {
        $this->selectedContact = Contact::with('category')->find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
