<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('login');


Route::get('/testing', function () {
    $keyword = "/(?<=sebesar ).\d+/";
    $keyword = str_replace("'", "", $keyword);

    // dd($keyword);
    $input_line = "Disaat Anda memerlukan pulsa, tersedia layanan Pulsa Siaga utk Anda ambil di *911#. Anda menerima Pulsa dari 62818310534111 sebesar 200000.";
    preg_match('/(\+62|62|0)[8][1-9][0-9]{6,9}/', $input_line, $number);
    preg_match($keyword, $input_line, $amount);
    dd($amount);
    // return view('welcome');
});
