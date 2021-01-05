<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardMediaBrowser extends Component
{
    public $medias;

    public function render()
    {
        return view('livewire.dashboard-media-browser');
    }
}
