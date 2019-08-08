<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

}
