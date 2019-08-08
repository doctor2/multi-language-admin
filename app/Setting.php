<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use Translatable;
    use LogsActivity;

    protected $fillable = [
        'key',
        'order',
        'description'
    ];

    public $translatedAttributes = [
        'name'
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'order' => 10,
    ];

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " with id({$this->id}) has been {$eventName}";
    }

    public function getNameAttribute()
    {
        return $this->translate()->name;
    }
}
