<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\JadwalPenagihanAngsuran\Models\Anggota;
use Faker\Factory;
use Faker\Generator;

class AnggotaTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		$faker 				= Factory::create();

		DB::table('anggota')->truncate();
		
		foreach (range(0, 50) as $value) 
		{
			$model 			= new Anggota;
			$model->fill([
					'nama'			=> $faker->name,
				]);

			$model->save();
		}
	}
}
