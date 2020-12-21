<?php

namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class FileDownloadController
 * @package App\Http\Controllers
 */
class FileDownloadController extends Controller
{
    /**
     * @param $file
     * @return BinaryFileResponse
     */
    public function download($file)
    {
        return response()->download(storage_path() . '/app/mnt/' . $file);

//        set_time_limit(0);
//
//        $fs = Storage::disk('local')->getDriver();
//
//        $fileName = '/mnt/' . $file;
//
//        $metaData = $fs->getMetadata($fileName);
//        $stream = $fs->readStream($fileName);
//
//        if (ob_get_level()) ob_end_clean();
//
//        return response()->stream( function () use ($stream) {
//                fpassthru($stream);
//            },
//            200,
//            [
//                'Content-Type' => $metaData['type'],
//                'Content-Length'      => $metaData['size'] ,
//                'Content-disposition' => 'attachment; filename="' . $file . '"',
//            ]);

    }
}
