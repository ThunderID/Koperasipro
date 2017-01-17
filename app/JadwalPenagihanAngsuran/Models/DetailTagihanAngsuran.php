<?php

namespace App\JadwalPenagihanAngsuran\Models;

use App\Models\BaseModel;
use App\JadwalPenagihanAngsuran\ModelObservers\CRUDAggregateVOObserver;

/**
 * Used for DetailTagihanAngsuran Models
 * 
 * @author cmooy
 */
class DetailTagihanAngsuran extends BaseModel
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table				= 'detail_tagihan_angsuran';

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
											'tagihan_angsuran_id'	,
											'keterangan'			,
											'nominal'				,
										];

	/**
	 * Basic rule of database
	 *
	 * @var array
	 */
	protected $rules				=	[
											'tagihan_angsuran_id'	=> 'required|max:255',
											'keterangan'			=> 'required',
											'nominal'				=> 'required|numeric',
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
 
        DetailTagihanAngsuran::observe(new CRUDAggregateVOObserver());
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
}
