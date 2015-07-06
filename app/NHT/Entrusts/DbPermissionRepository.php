<?php

namespace App\NHT\Entrusts;

use App\NHT\Core\BaseRepository;
use App\Permission;

/**
 * Class description.
 *
 * @author	AlvinTran
 */
class DbPermissionRepository extends BaseRepository implements PermistionRepository
{
	protected $model;

	public function __construct(Permission $model)
	{
		$this->model = $model;
	}

}