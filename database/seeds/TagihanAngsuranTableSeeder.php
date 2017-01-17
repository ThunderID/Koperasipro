<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\JadwalPenagihanAngsuran\Models\TagihanAngsuran;
use App\JadwalPenagihanAngsuran\Models\DetailTagihanAngsuran;
use Faker\Factory;
use Carbon\Carbon;

class TagihanAngsuranTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		DB::table('tagihan_angsuran')->truncate();
		DB::table('detail_tagihan_angsuran')->truncate();

		foreach (range(0, 100) as $value) 
		{
			$model 			= new TagihanAngsuran;
			$model->fill([
					'anggota_id'			=> rand(1,50),
					'tanggal_jatuh_tempo'	=> Carbon::now()->addDays(rand(-20, 20))->format('Y-m-d H:i:s')
				]);

			$model->save();

			$model_detail 	= new DetailTagihanAngsuran;

			$model_detail->fill([
					'tagihan_angsuran_id'	=> $model->id,
					'keterangan'			=> 'Tagihan Bulan '.rand(1,12),
					'nominal'				=> (rand(1, 10) * 1000) + (rand(1, 10) * 10000) + (rand(1, 10) * 100000) 
				]);

			$model_detail->save();
		}
	}
}
