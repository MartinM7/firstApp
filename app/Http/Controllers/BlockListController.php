<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlockListController extends Controller
{
    public function index(Request $request)
    {
        return view('blocklist');
    }
}
