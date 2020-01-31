<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $hidden = [
        'id',
    ];

    protected $fillable = [
        'field',
        'max_depth',
        'max_children'
    ];
}
