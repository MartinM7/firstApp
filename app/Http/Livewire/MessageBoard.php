<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class MessageBoard extends Component
{
    public $messages;

    protected $listeners = ['messageAdded' => 'incrementMessageCount'];

    public function mount()
    {
        $this->messages = Message::latest()->take(30)->get();
    }

    public function incrementMessageCount()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.message-board');
    }
}
