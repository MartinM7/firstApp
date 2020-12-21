<?php

namespace App\Http\Controllers;

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

        return view('files.index', [
            'files' => $files
        ]);
    }
}
