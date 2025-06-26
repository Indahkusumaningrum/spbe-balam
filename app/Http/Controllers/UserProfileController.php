<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show() 
    {
        $profile = Profile::first();
        return view('profile_show', compact('profile'));
    }
    
}
