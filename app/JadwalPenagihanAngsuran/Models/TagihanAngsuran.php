<?php

namespace App\JadwalPenagihanAngsuran\Models;

use App\Models\BaseModel;
use App\JadwalPenagihanAngsuran\ModelObservers\CRUDAggregateRootEntityObserver;

use Carbon\Carbon;


/**
 * Used for TagihanAngsuran Models
 * 
 * @author cmooy
 */
class TagihanAngsuran extends BaseModel
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table				= 'tagihan_angsuran';

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
											'anggota_id'			,
											'tanggal_tagihan'		,
										];

	/**
	 * Basic rule of database
	 *
	 * @var array
	 */
	protected $rules				=	[
											'anggota_id'			=> 'required|max:255',
											'tanggal_jatuh_tempo'	=> 'required|date_format:"Y-m-d H:i:s"',
										];

	/* ---------------------------------------------------------------------------- RELATIONSHIP ----------------------------------------------------------------------------*/
	/**
	 * call belongsto relationship
	 *
	 **/
	public function anggota()
	{
		return $this->belongsTo('\App\JadwalPenagihanAngsuran\Models\Anggota');
	}

	/**
	 * call hasmany relationship
	 *
	 **/
	public function details()
	{
		return $this->hasMany('\App\JadwalPenagihanAngsuran\Models\DetailTagihanAngsuran', 'tagihan_angsuran_id');
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
 
        TagihanAngsuran::observe(new CRUDAggregateRootEntityObserver());
	}

	public function TotalTagihan()
	{
		return DetailTagihanAngsuran::IDTagihanAngsuran($this->id)->sum('nominal');
	}

	/* ---------------------------------------------------------------------------- SCOPES ----------------------------------------------------------------------------*/

	public function scopeIDAnggota($query, $variable)
	{
		if(is_array($variable))
		{
			return $query->whereIn('anggota_id', $variable);
		}

		return $query->where('anggota_id', $variable);
	}

	public function scopeNamaAnggota($query, $variable)
	{
		return $query->whereHas('anggota', function($q)use($variable){return $q->name($variable);});
	}

	public function scopeTanggalJatuhTempo($query, Carbon $variable)
	{
		return $query->where('tanggal_jatuh_tempo', $variable->format('Y-m-d H:i:s'));
	}

	public function scopeTanggalJatuhTempo($query, Carbon $variable)
	{
		return $query->where('tanggal_jatuh_tempo', $variable->format('Y-m-d H:i:s'));
	}

	public function scopeTampilkanDenganTotalTagihan($query)
	{
		return $query
				->selectraw('tagihan_angsuran.*')
				->selectraw('IFNULL(SUM(nominal)) as total_tagihan')
				->join('detail_tagihan_angsuran', function ($join) use($variable) 
				 {
					$join->on('tagihan_angsuran.id', '=', 'detail_tagihan_angsuran.tagihan_angsuran_id')
						->wherenull('detail_tagihan_angsuran.deleted_at')
										;
				})
				->get();
		;
	}

	public function scopeBulan($query, $variable)
	{
		return $query->whereHas('detail', function($q)use($variable){return $q->bulan($variable);});
	}
}
