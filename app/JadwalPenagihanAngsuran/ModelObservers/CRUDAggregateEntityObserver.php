<?php 

namespace App\JadwalPenagihanAngsuran\ModelObservers;

use Illuminate\Support\MessageBag;

/**
 * Used in BaseModel model
 *
 * @author cmooy
 */
class CRUDAggregateEntityObserver 
{
	public function creating($model)
	{
		return $this->is_allowed($model, 'App\Services\*');
	}

	public function created($model)
	{
		return $this->is_allowed($model, 'App\Services\*');
	}

	public function saving($model)
	{
		return $this->is_allowed($model, 'App\Services\*');
	}

	public function saved($model)
	{
		return $this->is_allowed($model, 'App\Services\*');
	}

	public function updating($model)
	{
		return $this->is_allowed($model, 'App\Services\*');
	}

	public function updated($model)
	{
		return $this->is_allowed($model, 'App\Services\*');
	}
	
	public function deleting($model)
	{
		return $this->is_allowed($model, 'App\Services\*');
	}

	public function deleted($model)
	{
		return $this->is_allowed($model, 'App\Services\*');
	}

	public function is_allowed($model, $class)
	{
		$classes  = debug_backtrace();

		foreach ($classes as $key => $value) 
		{
		if(isset($value['class']) && str_is($class, $value['class']))
			{
				return true;
			}
		}

		$model['errors'] = ['Tidak bisa diakses dari luar business workflow'];

		return false;
	}
}
