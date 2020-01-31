<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'field',
        'max_depth',
        'max_children'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
