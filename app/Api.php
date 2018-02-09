<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $fillable = [
        'from', 
        'to', 
        'subject', 
        'html', 
    ];
}
