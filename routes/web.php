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
// 	if (DB::connection()->getDatabaseName())
// {
//    return 'Connected to the DB: ' . DB::connection()->getDatabaseName();
// }


	return \App\JadwalPenagihanAngsuran\Models\Anggota::all();
	$data 	= 	[
					'nama'			=> 'Chelsy Mooy',
					'gender'		=> 'female',
					'date_of_birth'	=> '1993-08-11',
					'address'		=> 'Puri Cempaka Putih II AS 86',
					'city'			=> 'Malang',
					'province'		=> 'East Java',
					'zipcode'		=> '65135',
					'country'		=> 'Indonesia',
					'mobile'		=> '089654562911',
					'whatsapp'		=> '089654562911',
					'ktp'			=> '3573035108930004',
					'npwp'			=> '74.220.569.3-623.000',
					'sim'			=> '930815250365',
				];

	$member = new \App\JadwalPenagihanAngsuran\Models\Anggota;

	$member->fill($data);
	$member->save();
	dd($member->getError());
	// $memberRepository 	= new \App\Registration\Repositories\MysqlMemberRepository;
	// $memberRepository->save($member);

exit;
    return view('welcome');
});
