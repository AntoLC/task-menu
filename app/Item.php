<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'menu_id',
        'parent_id',
        'has_children'
    ];

    protected $fillable = [
        'field',
        'menu_id',
        'parent_id',
        'has_children'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
