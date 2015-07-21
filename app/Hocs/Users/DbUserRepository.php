<?php

namespace Nht\Hocs\Users;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Users\User;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class DbUserRepository.
 *
 * @author	AlvinTran
 */
class DbUserRepository extends BaseRepository implements UserRepository
{

	protected $model;
	protected $auth;

	public function __construct(User $model, Guard $auth)
	{
		$this->model = $model;
		$this->auth = $auth;
	}

	public function getByEmail($email)
	{
		return $this->model->where('email', $email)->first();
	}

	public function getActivedUser($pageSize = 20)
	{
		$this->model->where('active', 1)->paginate($pageSize);
	}

	public function getCurrentUser()
	{
		return $this->auth->user();
	}

	public function isLogged()
	{
		return $this->auth->check();
	}

	public function isAdmin()
	{
		return $this->isLogged() && $this->getCurrentUser()->hasRole(['superadmin', 'admin']);
	}

}
