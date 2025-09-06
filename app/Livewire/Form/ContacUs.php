<?php

namespace App\Livewire\Form;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ContacUs extends Component
{
    public string $name = '';
    public string $email = '';
    public string $message = '';

    public function sendContact()
    {
        $this->validate([
            'name' => ['required', 'min:3', 'max:40'],
            'email' => ['required', 'email'],
            'message' => ['required', 'min:4', 'max:255']
        ]);

        // dispatch tidak berfungsi, gunakan session flash untuk status
        session()->flash('status', 'Message sent successfully!');
        $this->reset(['message']);
    }

    public function render()
    {
        return view('livewire.form.contac-us');
    }
}
