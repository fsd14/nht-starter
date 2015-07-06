<?php

namespace App\NHT\Entrusts;

/**
 * Interface description.
 *
 * @author	AlvinTran
 */
interface RoleRepository
{
	public function getByName($role);
}