<?php

namespace App\Modules\Sports\Models;

use App\Modules\Leagues\Models\League;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Sport extends Model implements HasMedia
{
    use HasSlug, SoftDeletes, NodeTrait, HasMediaTrait;

    protected $table = 'sports';


    protected $fillable = [
        'title', 'slug', 'visible'
    ];

    protected $casts = [
        'visible' => 'boolean'
    ];

    protected $with = ['media'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug')->doNotGenerateSlugsOnUpdate();
    }

    public function leagues() {
        return $this->hasMany(League::class, 'sport_api_id', 'api_id')->active();
    }

    public function scopeActive($query)
    {
        return $query->where($this->table . '.visible', 1);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(100)
            ->sharpen(10)
            ->nonOptimized();

        $this->addMediaConversion('small')
            ->width(250)
            ->height(250)
            ->sharpen(10)
            ->nonOptimized();
    }

}
