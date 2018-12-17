<?php
namespace Users\Services;

class UsersService
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the currently authenticated user or null.
     *
     * @return Illuminate\Auth\UserInterface|null
     */
    public function user()
    {
        return $this->app->auth->user();
    }

    /**
     * check if has specific role| check if has one of/all specified roles
     *
     * @param array|string $role
     * @param bool|null $requiredAll
     * @return bool
     */
    public function hasRole($role, ?bool $requiredAll = false): bool
    {
        $hasRole = false;
        if ($user = $this->user()) {
            $hasRole = $user->hasRole($role, $requiredAll);
        }
        return $hasRole;
    }
}