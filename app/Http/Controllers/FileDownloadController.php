<?php

namespace App\Http\Controllers;


use App\Models\Media;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class FileDownloadController
 * @package App\Http\Controllers
 */
class FileDownloadController extends Controller
{
    /**
     * @param Media $media
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function download(Media $media)
    {

//        return response()->download('/home/filme.serien.etc/' . $media->path);

        return response(null)
            ->header('X-Accel-Redirect', "/filme/$media->path")
            ->header('Content-Disposition', 'attachment; filename="' . $media->path . '"')
            ->header('Content-Type', '');

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
