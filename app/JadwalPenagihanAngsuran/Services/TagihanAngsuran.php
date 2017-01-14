<?php

namespace App\JadwalPenagihanAngsuran\Services;

/**
 * Using TagihanAngsuran Models
 * 
 * @author cmooy
 */
class TagihanAngsuran
{
	public static function cariBerdasarkanNamaAnggota(string $nama)
	{
		$models 		= TagihanAngsuran::namaAnggota($nama)->with(['detail_tagihan_angsuran'])->get();

		return $models->toArray();
	}

	public static function cariBerdasarkanIDAnggota(string $id)
	{
		$models 		= TagihanAngsuran::IDAnggota($id)->with(['detail_tagihan_angsuran'])->get();
		
		return $models->toArray();
	}

	public static function hitungTotalTagihan()
	{
		$models 		= TagihanAngsuran::tampilkanDenganTotalTagihan()->with(['detail_tagihan_angsuran'])->get();

		return $models->toArray();
	}

	public static function buatJadwalPenagihan(string $tagihan_id, string $bulan)
	{
		$angsuran 		= TagihanAngsuran::id($tagihan_id)->bulan(string $bulan)->first();

		if($this->apakahsudahlunas($angsuran))
		{
			//error
		}

		if(JadwalPenagihan::buatkanJadwalUntukAngsuran($angsuran))
		{
			//error
		}

		return $angsuran;
	}

	private function apakahsudahlunas(TagihanAngsuran $angsuran)
	{
		//here lies policies of lunas!
		return false;
	}
}
