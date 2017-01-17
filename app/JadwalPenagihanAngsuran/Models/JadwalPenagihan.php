<?php

namespace App\JadwalPenagihanAngsuran\Models;

use App\Models\BaseModel;
use App\JadwalPenagihanAngsuran\ModelObservers\CRUDAggregateRootEntityObserver;

use Carbon\Carbon;

/**
 * Used for JadwalPenagihan Models
 * 
 * @author cmooy
 */
class JadwalPenagihan extends BaseModel
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table				= 'jadwal_penagihan';

	/**
	 * Date will be returned as carbon
	 *
	 * @var array
	 */
	protected $dates				=	['created_at', 'updated_at', 'deleted_at', 'tanggal'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable				=	[
											'tagihan_angsuran_id'	,
											'petugas_id'			,
											'tanggal'				,
											'keterangan'			,
										];

	/**
	 * Basic rule of database
	 *
	 * @var array
	 */
	protected $rules				=	[
											'tagihan_angsuran_id'	=> 'required|max:255',
											'petugas_id'			=> 'required|max:255',
											'tanggal'				=> 'required|date_format:"Y-m-d H:i:s"',
											'keterangan'			=> 'required',
										];

	/* ---------------------------------------------------------------------------- RELATIONSHIP ----------------------------------------------------------------------------*/
	/**
	 * call belongsto relationship
	 *
	 **/
	public function petugas()
	{
		return $this->belongsTo('\App\JadwalPenagihanAngsuran\Models\Petugas');
	}

	/**
	 * call hasmany relationship
	 *
	 **/
	public function statuses()
	{
		return $this->hasMany('\App\JadwalPenagihanAngsuran\Models\Status', 'jadwal_penagihan_id');
	}

	/* ---------------------------------------------------------------------------- QUERY BUILDER ----------------------------------------------------------------------------*/
	
	/* ---------------------------------------------------------------------------- MUTATOR ----------------------------------------------------------------------------*/
	
	/* ---------------------------------------------------------------------------- ACCESSOR ----------------------------------------------------------------------------*/
	
	/* ---------------------------------------------------------------------------- FUNCTIONS ----------------------------------------------------------------------------*/
		
	/**
	 * boot
	 * observing model
	 *
	 */	
	public static function boot() 
	{
		parent::boot();
 
        JadwalPenagihan::observe(new CRUDAggregateRootEntityObserver());
	}

	/* ---------------------------------------------------------------------------- SCOPES ----------------------------------------------------------------------------*/

	public function scopeIDTagihanAngsuran($query, $variable)
	{
		if(is_array($variable))
		{
			return $query->whereIn('tagihan_angsuran_id', $variable);
		}

		return $query->where('tagihan_angsuran_id', $variable);
	}

	public function scopeTanggal($query, Carbon $variable)
	{
		return $query->whereBetween('tanggal', [$variable->startOfDay()->format('Y-m-d H:i:s'), $variable->endOfDay()->format('Y-m-d H:i:s')]);
	}

	public function scopeTampilkanStatus($query, $variable)
	{
		return $query
				->selectraw('jadwal_penagihan.*')
				// ->selectraw('IFNULL(status, NULL) as status')
				->leftjoin('status', function ($join)
				 {
		            $join->on ( 'status.jadwal_penagihan_id', '=', 'jadwal_penagihan.id' )
						->wherenull('status.deleted_at');
				})
				// ->orderby('status.tanggal')
				// ->groupby('jadwal_penagihan_id')
				->first();
		;
	}
}
