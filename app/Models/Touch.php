<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Touch extends Model
{
    protected $fillable = [
        'ig_account',
        'alternative_contact',
        'comments',
    ];
}
