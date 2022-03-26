<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    public $statusUpdate = 'false';
    public $paginate = 5;
    public $search;
    
    protected $listeners = [
        'contactStored',
        'contactUpdated',
        'contactDeleted',
    ];

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    
    public function render()
    {
        $contacts = Contact::latest()->paginate($this->paginate);

        // return view('livewire.contact-index', compact('contacts'));
        return view('livewire.contact-index', [
            'contacts' => $this->search === null ? $contacts :
            Contact::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate),
        ]);
    }

    public function getContact($id)
    {
        $this->statusUpdate = 'true';

        $contact = Contact::find($id);
        
        $this->emit('getContact', $contact);
    }

    public function contactStored($contact)
    {
        session()->flash('success', 'Contact ' . $contact['name'] . ' was Stored');
    }

    public function contactUpdated($contact)
    {
        session()->flash('updated', 'Contact ' . $contact['name'] . ' was Updated');

        $this->statusUpdate = 'false';
    }

    public function destroy($id)
    {
        if ($id) {
           $data = Contact::find($id);
           $data->delete();

           session()->flash('deleted', 'Contact was Deleted');
        }
    }
}
