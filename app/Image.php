<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use \Dimsav\Translatable\Translatable;


class Image extends Model
{
    use Translatable;

    protected $fillable = [
        'model_id',
        'model_type',
        'additional',
        'name',
        'path',
        'order',
        'active'
    ];

    public $translatedAttributes = [
        'title'
    ];

    protected $attributes = [
        'additional' => '[]',
        'order' => 10,
        'active' => 1
    ];

    protected $casts = [
        'additional' => 'array',
    ];

    public function project()
    {
        return BelongsToMorph::build($this, Project::class, 'model');
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function getFullPathAttribute()
    {
        return Storage::disk('public')->url($this->path);
    }

    public function getTitleAttribute()
    {
        return $this->translate()->title;
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            Storage::disk('public')->delete($item->path);
        });
    }
}
