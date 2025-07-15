<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;

class UserDownloadController extends Controller
{
    public function index(Request $request)
    {
        $query = Download::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $downloads = $query->get();

        $categories = Download::select('category')->distinct()->pluck('category');
        $years = Download::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('download_list', compact('downloads', 'categories', 'years'));
    }
}
