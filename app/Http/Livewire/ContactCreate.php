<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;

class ContactCreate extends Component
{    
    public $name, $phone;

    public function render()
    {
        return view('livewire.contact-create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Tidak boleh kosong',
            'phone.required' => 'Tidak boleh kosong'
        ]);
        
        $contact = Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);

        $this->resetInput();

        $this->emit('contactStored', $contact);
    }

    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
    }
}
