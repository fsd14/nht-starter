<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class description.
 *
 * @author	Andrea Marco Sartori
 */
class AdminController extends Controller
{

	public function index()
	{
		return view('admin.login');
	}

}