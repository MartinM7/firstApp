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
        $this->builder()->updateDatabeseFromFilesystem();
    }

    public function test()
    {
//        $this->medias = $this->medias->fresh();
//        dd($this->media);
//        $this->emit('refreshMedialist');
    }

    public function delete($id)
    {

        if($media = $this->model::findOrFail($id)){

            Storage::delete($media->path);

            $media->delete();

        }

    }

    public function render()
    {
        return view('livewire.dashboard-media-browser');
    }
}
