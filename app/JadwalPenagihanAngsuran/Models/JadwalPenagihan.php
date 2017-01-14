<?php

namespace App\JadwalPenagihanAngsuran\Models;

use App\Models\BaseModel;

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
	protected $dates				=	['created_at', 'updated_at', 'deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable				=	[
											'tagihan_id'			,
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
											'tagihan_id'			=> 'required|max:255',
											'petugas_id'			=> 'required|max:255',
											'tanggal'				=> 'required|date_format:"Y-m-d H:i:s"',
											'keterangan'			=> 'required',
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
 
        JadwalPenagihan::observe(new CRUDAggregateRootEntityObserver());
	}

	/* ---------------------------------------------------------------------------- SCOPES ----------------------------------------------------------------------------*/
}
