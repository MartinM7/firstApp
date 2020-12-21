<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
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
                ['filename' => $file['filename']],
                [
                    'user_id' => auth()->id(),
                    'type' => $file['type'],
                    'path' => $file['path'],
                    'size' => $file['size'],
                    'basename' => $file['basename'],
                    'extension' => $file['extension'],
                    'filename' => $file['filename']
                ]
            );
        }

        return view('files.index', [
            'files' => $files
        ]);
    }
}
