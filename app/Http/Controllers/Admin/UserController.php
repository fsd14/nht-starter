<?php

namespace Nht\Http\Controllers\Admin;

use Nht\Hocs\Users\UserRepository;
use Nht\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Nht\Http\Requests\AdminUserFormRequest;

/**
 * Class description.
 *
 * @author  AlvinTran
 */
class UserController extends AdminController
{
	protected $user;

	public function __construct(UserRepository $user)
	{
		$this->user = $user;
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
      $email = $request->get('email');
      $phone = $request->get('phone');
      $users = $this->user->getAllWithPaginate(['email' => $email, 'phone' => $phone]);
		return view('admin/users/index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin/users/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AdminUserFormRequest $request)
	{
		if ($this->user->create($request->except('_token', '_method')))
		{
			return redirect()->route('user.create')->with('success', trans('general.messages.create_success'));
		}
		return redirect()->back()->withInputs()->with('error', trans('general.messages.create_fail'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->getById($id);
		return view('admin/users/edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, AdminUserFormRequest $request)
	{
		if ($this->user->update($request->except('_token', '_method'), ['id' => $id]))
		{
			return redirect()->route('user.edit', $id)->with('success', trans('general.messages.update_success'));
		}
		return redirect()->back()->withInputs()->with('error', trans('general.messages.update_fail'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($this->user->delete($id))
		{
			return redirect()->route('user.index')->with('success', trans('general.messages.delete_success'));
		}
		return redirect()->route('user.index')->with('error', trans('general.messages.delete_fail'));
	}
}
