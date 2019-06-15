<?php

namespace App\Modules\Leagues\Models;

use App\Modules\Sports\Models\Sport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class League extends Model {
    use HasSlug, SoftDeletes, NodeTrait;

    protected $table = 'leagues';


    protected $fillable = [
        'title', 'slug', 'visible'
    ];

    protected $casts = [
        'visible' => 'boolean'
    ];

    public function getSlugOptions(): SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug')->doNotGenerateSlugsOnUpdate();
    }

    public function sport() {
        return $this->hasOne(Sport::class, 'api_id', 'sport_api_id');
    }
}
