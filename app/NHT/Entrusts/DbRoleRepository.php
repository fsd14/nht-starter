<?php

namespace App\NHT\Entrusts;

use App\NHT\Core\BaseRepository;
use App\Role;

class DbRoleRepository extends BaseRepository implements RoleRepository {

	protected $model;

	public function __construct(Role $model)
	{
		$this->model = $model;
	}

	public function getByName($role)
	{
		return $this->model->where('name', $role)->first();
	}
}