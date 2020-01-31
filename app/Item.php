<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
