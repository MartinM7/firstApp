<?php

namespace App\Http\Livewire;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DashboardMediaBrowser extends Component
{
    public $medias;
    public $updateDatabase = false;
    protected $listeners = ['refreshMedialist' => '$refresh'];

    public function updateDatabase()
    {

        $files = Storage::disk('local')->listcontents('/mnt', true);

        usort($files, function ($first, $second) {
            return $second['timestamp'] <=> $first['timestamp'];
        });

        $files = array_filter($files, function ($file){
            return $file['type'] === 'file' && $file['extension'] !== 'nfo';
        });

        foreach ($files as $file){
            Media::firstOrCreate(
                ['basename' => $file['basename']],
                [
                    'user_id' => auth()->id(),
                    'type' => $file['type'],
                    'path' => $file['path'],
                    'size' => $file['size'],
                    'basename' => $file['basename'],
                    'extension' => $file['extension'],
                    'filename' => $file['filename'],
                    'time' => $file['timestamp']
                ]
            );
        }

        redirect()->to('/dashboard');

    }

    public function test()
    {
        $this->medias = $this->medias->fresh();
        dd($this->medias);
//        $this->emit('refreshMedialist');
    }

    public function delete($id)
    {

        if($media = Media::findOrFail($id)){

            Storage::delete($media->path);

            $media->delete();

        }

        $this->medias = $this->medias->fresh();
    }


    public function render()
    {
        return view('livewire.dashboard-media-browser');
    }
}
