<?php

namespace Nht\Hocs\Core;

use Nht\Http\Requests\Request;

/**
 * An abstract class for repository.
 *
 * @author	AlvinTran
 */
abstract class BaseRepository
{
	/**
	 * Get all items of model
	 * @return Illuminate\Support\Collection Model collections
	 */
	public function getAll()
	{
		return $this->model->all();
	}

	/**
	 * Get item of model
	 * @param  int $id Model ID
	 * @return Model
	 */
	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	/**
	 * Get items with filter & paginate
	 * @param  array  $filter
	 * @param  integer $pageSize
	 * @return Illuminate\Support\Collection Model collections
	 */
	public function getAllWithPaginate($filter = [], $pageSize = 1)
	{
		if ( ! empty($filter))
		{
			foreach ($filter as $key => $value)
			{
				if ($value == '')
				{
					unset($filter[$key]);
				}
			}
			return $this->model->where($filter)->paginate($pageSize);
		}
		return $this->model->paginate($pageSize);
	}

	/**
	 * Create a new model
	 * @param  array $attributes
	 * @return Bool
	 */
	public function create($attributes)
	{
		return $this->model->create($attributes);
	}

	/**
	 * Update an exitst model
	 * @param  array $attributes
	 * @param  array $condition
	 * @return Bool
	 */
	public function update($attributes, $condition = [])
	{
		if ( ! empty($condition))
		{
			return $this->model->where($condition)->update($attributes);
		}
		return $this->model->update($attributes);
	}

	/**
	 * Delete an exist model
	 * @return Bool
	 */
	public function delete()
	{
		return $this->model->delete();
	}
}
