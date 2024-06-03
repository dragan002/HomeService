<?php

namespace App\Livewire;

use Livewire\Component;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;

    public function sendMessage() {
        $this->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'message'=>'required'
        ]);
    }
    public function render()
    {
        return view('livewire.contact-component')->layout('layout.base');
    }
}
