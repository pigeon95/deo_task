<?php
namespace Dashboard\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;

class HomeController extends Controller
{
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction()
    {
        $user = $this->authManager->user();
        return view('dashboard::home.index', compact('user'));
    }
}
