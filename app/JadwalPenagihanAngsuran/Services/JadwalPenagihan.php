<?php

namespace App\JadwalPenagihanAngsuran\Services;

/**
 * Using JadwalPenagihan Models
 * 
 * @author cmooy
 */
class JadwalPenagihan
{
	public static function buatkanJadwalUntukAngsuran(TagihanAngsuran $angsuran)
	{
		$tanggal_penagihan 	= $this->generateTanggalPenagihan();
	}
}
