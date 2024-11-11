<?php

namespace App\Http\Controllers;

use App\Models\TwitterData;
use App\Models\FacebookData;

class SocialMediaController extends Controller
{
    public function index()
    {
        $twitterData = TwitterData::all();
        $facebookData = FacebookData::all();
        return view('dashboard', compact('twitterData', 'facebookData'));
    }
}
