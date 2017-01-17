<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () 
{
	$data  = \App\JadwalPenagihanAngsuran\Models\JadwalPenagihan::IDTagihanAngsuran(27)->with(['statuses'])->orderby('created_at', 'desc')->first();
	dd($data);

	$data  = new \App\JadwalPenagihanAngsuran\Services\TagihanAngsuran;

	return $data->buatkanJadwal(27);

    return view('welcome');
});
