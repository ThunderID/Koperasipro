<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\JadwalPenagihanAngsuran\Models\Petugas;
use Faker\Factory;
use Faker\Generator;

class PetugasTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		$faker 				= Factory::create();

		DB::table('petugas')->truncate();
		
		foreach (range(0, 50) as $value) 
		{
			$model 			= new Petugas;
			$model->fill([
					'nama'	=> $faker->name,
				]);

			$model->save();
		}
	}
}
