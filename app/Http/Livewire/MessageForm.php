<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MessageForm extends Component
{
    public $body = '';

    protected $rules = [
        'body' => 'required'
    ];

    public function storeMessage()
    {
        $this->validate();

        auth()->user()->messages()->create(['body' => $this->body]);

        $this->body = '';

        $this->emit('messageAdded');

    }

    public function render()
    {
        return view('livewire.message-form');
    }
}
