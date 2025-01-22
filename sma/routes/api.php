<?php

use App\Http\Controllers\SocialMediaController;
use Illuminate\Support\Facades\Route;


Route::post('/forecast', [SocialMediaController::class, 'getForecast']);

Route::get('/search', [SocialMediaController::class, 'search']);



Route::get('/facebook/posts', [SocialMediaController::class, 'getPagePosts']);
