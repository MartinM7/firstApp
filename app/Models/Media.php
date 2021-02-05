<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function updateDatabaseFromFilesystem()
    {
        $files = Storage::disk('media')->listcontents('/', true);

        usort($files, function ($first, $second) {
            return $second['timestamp'] <=> $first['timestamp'];
        });

        $files = array_filter($files, function ($file){
            return $file['type'] === 'file' && $file['extension'] !== 'nfo';
        });

        foreach ($files as $file){
            $this::firstOrCreate(
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
    }

    public function sizeForHumans()
    {
        $bytes = $this->size;

        $units = [' B', ' kB', ' MB', ' GB', ' TB', ' PB'];

        for ($i = 0; $bytes > 1024; $i ++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . $units[$i];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
