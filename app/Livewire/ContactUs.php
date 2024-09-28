<?php

namespace App\Livewire;

use App\Models\contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactUs extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public $message;
    public function render()
    {
        $Contact_us = contact::paginate(5);
        return view('livewire.contact-us', compact('Contact_us'));
    }

    public function deleteContact(int $id)
    {
        $contact = contact::find($id);
        if($contact){
            $this->id = $contact->id;
            $this->message = $contact->message;
        } else {
            return redirect()->back();
        }
    }

    public function destroyContact(){
        contact::find($this->id)->delete();
        session()->flash('delete', 'message deleted Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->message = '';
    }


}
