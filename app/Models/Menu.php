<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Menu extends Model
{
    //
    public function parent(): Menu|HasOne
    {
        return $this->hasOne(Menu::class, 'parent_id');
    }

    public function children(): Menu|HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
