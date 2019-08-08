<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use LogsActivity;
    use Translatable;
    use StorageImage;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

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
    protected $fillable = [
        'year',
        'city_id',
        'order',
        'active'
    ];

    /**
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'additional',
        'additional_multi'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            $item->images->each->delete();
        });
    }

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

    public function getPreviewImagePathAttribute()
    {
        $preview_image_path = null;
        if ($image = $this->getByName('preview_image')) {
            $preview_image_path = $image->path;
        }

        return $preview_image_path;
    }

    public function getPreviewImageFullAttribute()
    {
        $preview_image_full = null;
        if ($image = $this->getByName('preview_image')) {
            $preview_image_full = $image->full_path;
        }

        return $preview_image_full;
    }

    public function getTitleAttribute()
    {
        return $this->translate()->title;
    }

    public function getActiveHtmlAttribute()
    {
        return $this->active ? '✅' : '';
    }
}
