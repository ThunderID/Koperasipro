<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\JadwalPenagihanAngsuran\Models\Status;
use App\JadwalPenagihanAngsuran\Models\TagihanAngsuran;
use App\JadwalPenagihanAngsuran\Models\JadwalPenagihan;
use Faker\Factory;
use Carbon\Carbon;

class JadwalPenagihanTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		DB::table('jadwal_penagihan')->truncate();
		DB::table('status')->truncate();

		foreach (range(0, 50) as $value) 
		{
			$invoice 		= TagihanAngsuran::id(rand(1,100))->with(['anggota'])->first();

			$model 			= new JadwalPenagihan;
			$model->fill([
					'tagihan_angsuran_id'	=> $invoice->id,
					'petugas_id'			=> rand(1,50),
					'tanggal'				=> $invoice->tanggal_jatuh_tempo->addDays(2)->format('Y-m-d H:i:s'),
					'keterangan'			=>'Penagihan atas nama '.$invoice->anggota->nama
				]);

			$model->save();

			$model_detail 	= new Status;

			$model_detail->fill([
					'jadwal_penagihan_id'	=> $model->id,
					'petugas_id'			=> $model->petugas_id,
					'tanggal'				=> Carbon::now()->format('Y-m-d H:i:s'),
					'status'				=> 'belum_ditagih' 
				]);

			$model_detail->save();
		}
	}
}
