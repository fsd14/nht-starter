<?php

namespace App\NHT\Users;

/**
 * Interface description.
 *
 * @author	AlvinTran
 */
interface UserRepository
{
	public function getByEmail($email);
	public function getActivedUser();
}