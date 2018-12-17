<?php
namespace Users\Events\Listners;

use Users\Events\LoginAttemptEvent;
use Users\Models\LoginRegister;

class LoginListner
{
    public function handle(LoginAttemptEvent $event)
    {
        if(config('users.register_logins')) {
            $register = new LoginRegister($event->toArray());
            $register->save();
        }
    }
}