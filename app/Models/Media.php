<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function updateDatabeseFromFilesystem()
    {
        $files = Storage::disk('local')->listcontents('/mnt', true);

        if (!count($files)){
            dd('empty');
        }

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
                    'user_id' => 1,
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
