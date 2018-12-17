<?php

namespace Dashboard\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public $table = 'email';

    public $fillable = ['subject', 'email', 'content', 'agreement', 'date'];
}
