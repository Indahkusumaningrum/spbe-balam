<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class UserDownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::all();
        return view('download_list', compact('downloads'));
    }
}
