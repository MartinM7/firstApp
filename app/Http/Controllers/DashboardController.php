<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $medias = Media::orderByDesc('time')->get();

        return view('dashboard',);
    }
}
