<?php

namespace App\Modules\Sports\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Sport extends Model
{
    use HasSlug, SoftDeletes, NodeTrait;

    protected $table = 'sports';


    protected $fillable = [
        'title', 'slug', 'visible'
    ];

    protected $casts = [
        'visible' => 'boolean'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug')->doNotGenerateSlugsOnUpdate();
    }
}
