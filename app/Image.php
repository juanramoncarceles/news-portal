<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function news()
    {
        return $this->hasOne('App\News');
    }
}
