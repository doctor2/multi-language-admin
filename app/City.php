<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    use LogsActivity;
    use Translatable;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['value', 'order', 'active'];

    /**
     * @var array
     */
    protected $attributes = [
        'order' => 10,
        'active' => 1
    ];

    /**
     * @var array
     */
    public $translatedAttributes = [
        'name'
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

    public function getActiveHtmlAttribute()
    {
        return $this->active ? '✅' : '';
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_cities');
    }
}
