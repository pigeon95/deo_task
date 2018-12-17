<?php

namespace Users\Controllers\Auth;

use Illuminate\Http\Request;
use Users\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Users\Contracts\UserInterface;
use Users\Events\LoginAttemptEvent;
use Users\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $loginView = "users::auth.login";
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = $this->getUser($request->get($this->username()));

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->fireLoginAttemptEvent($user, false, 'Normal login, to many attempts');

            return $this->sendLockoutResponse($request);
        }
        if ($user instanceof UserInterface && in_array($user->getStatus(), config('users.active_status'))) {
            if ($this->attemptLogin($request)) {
                $this->fireLoginAttemptEvent($user);

                return $this->sendLoginResponse($request);
            }
            $this->fireLoginAttemptEvent($user, false, 'Normal login, wrong credentials');
        } else {
            $this->fireLoginAttemptEvent($user, false, 'Normal login, user not active');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * get user based on username
     *
     * @param string $username
     * @return null|UserInterface
     */
    public function getUser($username): ?UserInterface
    {
        $usernameField = $this->username();
        $userClass = config('auth.users.model', User::class);
        return $userClass::where($usernameField, $username)->first();
    }

    /**
     * @param null|UserInterface $user
     * @param bool $success
     * @param string $details
     * @return int
     */
    public function fireLoginAttemptEvent(?UserInterface $user, bool $success = true, string $details = 'Normal login'): int
    {
        if (!($user instanceof UserInterface)) {
            return 0;
        }
        event(new LoginAttemptEvent($user->getId(), $success, $details));
        return 1;
    }
}
