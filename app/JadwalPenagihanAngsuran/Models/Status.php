<?php

namespace App\JadwalPenagihanAngsuran\Models;

use App\Models\BaseModel;

/**
 * Used for Status Models
 * 
 * @author cmooy
 */
class Status extends BaseModel
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table				= 'status';

	/**
	 * Date will be returned as carbon
	 *
	 * @var array
	 */
	protected $dates				=	['created_at', 'updated_at', 'deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable				=	[
											'jadwal_penagihan_id'	,
											'petugas_id'			,
											'tanggal'				,
											'status'				,
										];

	/**
	 * Basic rule of database
	 *
	 * @var array
	 */
	protected $rules				=	[
											'jadwal_penagihan_id'	=> 'required|max:255',
											'petugas_id'			=> 'required|max:255',
											'tanggal'				=> 'required|date_format:"Y-m-d H:i:s"',
											'status'				=> 'required|in:sudah_ditagih,belum_ditagih',
										];

	/* ---------------------------------------------------------------------------- RELATIONSHIP ----------------------------------------------------------------------------*/
	
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
 
        Status::observe(new CRUDAggregateEntityObserver());
	}

	/* ---------------------------------------------------------------------------- SCOPES ----------------------------------------------------------------------------*/
}
