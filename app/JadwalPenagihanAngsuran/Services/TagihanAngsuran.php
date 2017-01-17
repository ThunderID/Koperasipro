<?php

namespace App\JadwalPenagihanAngsuran\Services;

use App\JadwalPenagihanAngsuran\Models\TagihanAngsuran as TagihanAngsuranModel;
use App\JadwalPenagihanAngsuran\Models\JadwalPenagihan as JadwalPenagihanModel;

use Carbon\Carbon;

/**
 * Using TagihanAngsuran Models
 * 
 * @author cmooy
 */
class TagihanAngsuran extends BaseService 
{
	public static function cariBerdasarkanIDAnggota(string $id)
	{
		$models		= TagihanAngsuranModel::IDAnggota($id)->with(['details'])->get();
		
		return $models->toArray();
	}

	public static function cariBerdasarkanNamaAnggota(string $nama)
	{
		$models		= TagihanAngsuranModel::namaAnggota($nama)->with(['details'])->get();

		return $models->toArray();
	}

	public static function cariBerdasarkanTanggalJatuhTempo(Carbon $tanggal)
	{
		$models		= TagihanAngsuranModel::TanggalJatuhTempo($tanggal)->with(['details', 'anggota'])->get();
		
		return $models->toArray();
	}

	public static function hitungTotalTagihan()
	{
		$models		= TagihanAngsuranModel::tampilkanDenganTotalTagihan();

		return $models->toArray();
	}

	public function buatkanJadwal(string $tagihan_id)
	{
		$angsuran	= TagihanAngsuranModel::id($tagihan_id)->first();

		if($this->apakahSudahLunas($angsuran))
		{
			$this->errors->add('Lunas', 'Tagihan Sudah Lunas');

			return false;
		}

		$jadwal		= new JadwalPenagihan;
		
		$jadwal->buatkanJadwalTagihanAngsuran($angsuran);

		return true;
	}

	private function apakahSudahLunas(TagihanAngsuranModel $angsuran)
	{
		if(JadwalPenagihanModel::IDTagihanAngsuran($angsuran->id)->count())
		{
			$jadwal		= JadwalPenagihanModel::IDTagihanAngsuran($angsuran->id)->tampilkanStatus(Carbon::now());

			if(!str_is($jadwal->status, 'sudah_ditagih'))
			{
				return false;
			}

			return true;
		}

		return false;
	}
}
