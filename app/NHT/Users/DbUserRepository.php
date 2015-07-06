<?php

namespace App\NHT\Users;

use App\NHT\Core\BaseRepository;
use App\NHT\Users\User;

/**
 * Class DbUserRepository.
 *
 * @author	AlvinTran
 */
class DbUserRepository extends BaseRepository implements UserRepository
{

	protected $model;

	public function __construct(User $model)
	{
		$this->model = $model;
	}

	public function getByEmail($email)
	{
		return $this->model->where('email', $email)->first();
	}

	public function getActivedUser()
	{
		$this->model->where('active', 1)->get();
	}

}