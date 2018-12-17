<?php

namespace Dashboard\Services;

use Dashboard\Models\Email;
use Illuminate\Support\Facades\Auth;

class EmailService
{
    /**
     * @param array $data
     * @return Email
     */
    public function save(array $data): Email
    {
        $email = new Email($data);
        $email->email = Auth::user()->email;
        $email->save();
        return $email;
    }
}