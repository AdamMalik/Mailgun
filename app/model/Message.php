<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'subject', 
        'to_user', 
        'from_user', 
        'message', 
        'read',
        'role'
    ];
}
