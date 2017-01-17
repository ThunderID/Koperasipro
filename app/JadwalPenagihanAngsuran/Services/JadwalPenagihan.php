<?php

namespace App\JadwalPenagihanAngsuran\Services;

use App\JadwalPenagihanAngsuran\Models\JadwalPenagihan as JadwalPenagihanModel;
use App\JadwalPenagihanAngsuran\Models\TagihanAngsuran as TagihanAngsuranModel;
use App\JadwalPenagihanAngsuran\Models\Status as StatusModel;
use App\JadwalPenagihanAngsuran\Models\Petugas;

use Carbon\Carbon;

/**
 * Using JadwalPenagihan Models
 * 
 * @author cmooy
 */
class JadwalPenagihan extends BaseService
{
	public function eksekusiPenagihan(string $id)
	{
		$models				= JadwalPenagihanModel::id($id)->first();

		if(!$this->changeStatus($models, 'sudah_ditagih'))
		{
			return false;
		}

		return true;
	}

	public function batalkanPenagihan(string $id)
	{
		$models				= JadwalPenagihanModel::id($id)->first();

		if(!$this->changeStatus($models, 'batal_ditagih'))
		{
			return false;
		}

		return true;
	}

	public static function cariBerdasarkanTanggalTagihan(Carbon $tanggal)
	{
		$models				= JadwalPenagihanModel::tanggal($tanggal)->get();
		
		return $models->toArray();
	}

	public function buatkanJadwalTagihanAngsuran(TagihanAngsuranModel $angsuran)
	{
		$tanggal_penagihan 	= $this->generateTanggalPenagihan($angsuran->tanggal_jatuh_tempo);

		$petugas 			= $this->cariDebtCollectorIdlePer($tanggal_penagihan);

		$jadwal 			= new JadwalPenagihanModel;

		$jadwal->fill([
						'tagihan_angsuran_id'	=> $angsuran->id,
						'petugas_id'			=> $petugas->id,
						'tanggal'				=> $tanggal_penagihan->format('Y-m-d H:i:s'),
						'keterangan'			=> 'Penagihan atas nama ',$angsuran->anggota->nama.' sebesar '.$angsuran->TotalTagihan(),
			]);

		if(!$jadwal->save())
		{
			$this->errors 		= $jadwal->getError();
			
			return false;
		}

		if(!$this->changeStatus(JadwalPenagihanModel::find($jadwal->id), 'belum_ditagih'))
		{
			return false;
		}

		return true;
	}

	private function generateTanggalPenagihan(Carbon $tanggal_jatuh_tempo)
	{
		$tanggal_penagihan		= $tanggal_jatuh_tempo->addDays('2');

		while(in_array(strtolower($tanggal_penagihan->format('l')), ['sunday'])) 
		{
			$tanggal_penagihan	= $tanggal_penagihan->addDays(1);
		}

		return $tanggal_penagihan;
	}

	private function cariDebtCollectorIdlePer(Carbon $tanggal_penagihan)
	{
		$petugas_sibuk 		= JadwalPenagihanModel::tanggal($tanggal_penagihan)->get(['petugas_id']);

		if(count($petugas_sibuk))
		{
			$petugas_id 	= Petugas::notid($petugas_sibuk)->first();
		}
		else
		{
			$petugas_id 	= Petugas::first();
		}

		return $petugas_id;
	}

	private function changeStatus(JadwalPenagihanModel $jadwalpenagihan, string $proposed_status)
	{
		$status 			= new StatusModel;
		$status->fill([
			'jadwal_penagihan_id' 	=> $jadwalpenagihan->id, 
			'petugas_id' 			=> $jadwalpenagihan->petugas_id, 
			'tanggal' 				=> Carbon::now()->format('Y-m-d H:i:s'), 
			'status' 				=> $proposed_status,
		]);

		if(!$status->save())
		{
			$this->errors 	= $status->getError();

			return false;
		}

		return true;
	}
}
