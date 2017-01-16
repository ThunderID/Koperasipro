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

		$petugas 			= $this->cariDebtCollectorIdlePer($tanggal_penagihan);

		$jadwal 			= new JadwalPenagihan;

		$jadwal->fill([
						'tagihan_id'			=> $angsuran->id,
						'petugas_id'			=> $petugas->id,
						'tanggal'				=> $tanggal_penagihan->format('Y-m-d H:i:s'),
						'keterangan'			=> 'Penagihan atas nama ',$angsuran->anggota->nama.' sebesar '.$angsuran->TotalTagihan(),
			]);

		if($jadwal->save())
		{
			return true;
		}

		return false;
	}
}
