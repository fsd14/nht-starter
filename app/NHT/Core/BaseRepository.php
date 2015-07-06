<?php

namespace App\NHT\Core;

/**
 * An abstract class for repository.
 *
 * @author	AlvinTran
 */
abstract class BaseRepository
{
	public function getAll()
	{
		return $this->model->all();
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}

	public function getAllWithPaginate($paginate = 20)
	{
		return $this->model->paginate($paginate)->get();
	}

	public function create(FormRequest $request)
	{
		return $this->model->create($request->all());
	}

	public function update(FormRequest $request)
	{
		return $this->model->update($request->all());
	}

	public function delete()
	{
		return $this->model->delete();
	}
}