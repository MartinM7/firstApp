<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserBlocklist extends Component
{

    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function toggle($user)
    {
        auth()->user()->toggleBlockUser(User::find($user));
    }

    public function render()
    {
        return view('livewire.user-blocklist');
    }
}
