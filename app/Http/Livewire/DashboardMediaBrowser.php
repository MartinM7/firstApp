<?php

namespace App\Http\Livewire;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardMediaBrowser extends Component
{
    use WithPagination;

//    public $media;
    public $model;
    public $updateDatabase = false;
    public $query;
    public $confirmingMediaDeletion;

    public function mount()
    {
//        $this->media = new Media();
    }

    public function builder()
    {
        return new $this->model;
    }

    public function allMedia()
    {
        if ($this->query){
            return $this->builder()->where('filename', 'like', "%{$this->query}%")->paginate(10);
        }

        return $this->builder()->orderByDesc('time')->paginate(10);
    }

    public function updateDatabase()
    {
        $this->builder()->updateDatabaseFromFilesystem();
    }

    public function deleteMedia()
    {
        if($media = $this->model::findOrFail($this->confirmingMediaDeletion)){

            Storage::drive('media')->delete($media->path);

            $media->delete();

            $this->confirmingMediaDeletion = null;

        }
    }

    public function render()
    {
        return view('livewire.dashboard-media-browser');
    }
}
