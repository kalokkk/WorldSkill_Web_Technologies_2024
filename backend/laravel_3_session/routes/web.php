<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Route::get('/form', function() {
    return view('form');
});

Route::post('/form', function(Request $request) {
    $input = $request->input('form_name');
    if (!isset($input)) {
        return response('form name not exists', 403);
    }

    $request->session()->put('form_name', $input);
    return redirect('/session');
});

Route::get('/session', function(Request $request) {
    if ($request->session()->has('form_name')) {
        return response($request->session()->get('form_name'), 200);
    }
    else {
        return response('form name not exists', 404);
    }
});