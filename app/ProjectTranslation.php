<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'additional',
        'additional_multi',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'title' => '',
        'additional' => '',
        'additional_multi' => '[]',
    ];

    protected $casts = [
        'additional_multi' => 'array',
    ];
}
