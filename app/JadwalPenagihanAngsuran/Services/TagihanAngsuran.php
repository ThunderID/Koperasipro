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

	public static function bayarTagihanPerBulan(string $tagihan_id, string $bulan)
	{
		$angsuran 		= TagihanAngsuran::id($tagihan_id)->find();
		
		if(TagihanAngsuran::angsuran(string $tagihan))
		{
			//error
		}

		if(!TagihanAngsuran::bayarAngsuranBulan(string $bulan))
		{
			//error
		}

		$models 		= TagihanAngsuran::angsuranBulan()->with(['detail_tagihan_angsuran'])->get();

		return $models->toArray();
	}
}
