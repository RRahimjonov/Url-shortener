<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Models\Link;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $links = Link::select('original_url', 'short_code', 'click')->get();
    return view('welcome', compact('links'));
});

Route::get('/test', function(){
    return view('404');
});

Route::post('/shorten', [LinkController::class, 'store']);

Route::get('/{shortCode}', [LinkController::class, 'redirect']);
