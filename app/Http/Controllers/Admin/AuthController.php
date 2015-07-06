<?php namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\AdminLoginFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

/**
 * Class description.
 *
 * @author	Andrea Marco Sartori
 */
class AuthController extends Controller
{
	use ThrottlesLogins;

	protected $auth;
	protected $loginPath = '/admin/login';
	protected $redirectPath = '/admin/dashboard';

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Get login view
	 * @return View
	 */
	public function login()
	{
		if ($this->auth->check() && $this->auth->user()->hasRole('admin')) {
			return redirect($this->redirectPath());
		}
		return view('admin.login');
	}

	/**
	 * Get logout
	 * @return Redirect
	 */
	public function logout()
	{
		$this->auth->logout();
		return redirect($this->loginPath());
	}

	/**
	 * Authentication login admin
	 * @param  AdminLoginFormRequest $request
	 * @return Redirect
	 */
	public function authenticate(AdminLoginFormRequest $request)
	{
		// Throttles login
		if ($this->hasTooManyLoginAttempts($request)) {
         return $this->sendLockoutResponse($request);
      }

		if ($this->auth->attempt($this->getCredentials($request), $request->has('remember'))) {
			$this->clearLoginAttempts($request);
			return redirect()->intended($this->redirectPath());
		}

		$this->incrementLoginAttempts($request);
		$countLoginFails = $this->getLoginAttempts($request) - 1;
		return back()->withInput()->with(['message' => 'Sai thông tin đăng nhập!', 'countLoginFails' => $countLoginFails]);
	}

	/**
	 * View dashboard
	 * @return View
	 */
	public function dashboard()
	{
		return view('admin.partials.dashboard');
	}

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function loginUsername()
	{
		return 'email';
	}

	/**
    * Get the path to the login route.
    *
    * @return string
    */
   public function loginPath()
   {
      return $this->loginPath;
   }

   /**
    * Get the path to the login route.
    *
    * @return string
    */
   public function redirectPath()
   {
      return $this->redirectPath;
   }

   /**
    * Get the needed authorization credentials from the request.
    *
    * @param  AdminLoginFormRequest  $request
    * @return array
    */
   protected function getCredentials(AdminLoginFormRequest $request)
   {
      return $request->only($this->loginUsername(), 'password');
   }
}
