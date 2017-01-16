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

	public static function cariBerdasarkanTanggalJatuhTempo(DateTime $tanggal)
	{
		$models 		= TagihanAngsuran::JatuhTempo($tanggal)->with(['detail_tagihan_angsuran'])->get();
		
		return $models->toArray();
	}

	public static function hitungTotalTagihan()
	{
		$models 		= TagihanAngsuran::with(['detail_tagihan_angsuran'])->tampilkanDenganTotalTagihan();

		return $models->toArray();
	}

	public static function buatJadwalPenagihan(string $tagihan_id, string $bulan)
	{
		$angsuran 		= TagihanAngsuran::id($tagihan_id)->bulan(string $bulan)->first();

		if($this->apakahSudahLunas($angsuran))
		{
			return false;
		}

		$jadwal 	= JadwalPenagihan::buatkanJadwalUntukAngsuran($angsuran)

		return true;
	}

	private function apakahSudahLunas(TagihanAngsuran $angsuran)
	{
		$status 			= $angsuran->tampilkanStatus('now');

		if(str_is($status, 'lunas'))
		{
			return true;
		}

		return false;
	}
}
