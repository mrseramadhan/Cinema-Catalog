<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Movie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Movie::class, 'list']);
Route::get('/detailMovie/{id}', [Movie::class, 'detail']);
Route::post('/addMovie', [Movie::class, 'create']);
Route::post('/updateMovie', [Movie::class, 'update']);
Route::post('/deleteMovie', [Movie::class, 'delete']);
Route::get('/addMovie',function(){return redirect()->back();});
Route::get('/updateMovie',function(){return redirect()->back();});
Route::get('/deleteMovie',function(){return redirect()->back();});
