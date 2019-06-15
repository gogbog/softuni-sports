<?php

namespace App\Modules\Fixtures\Models;

use App\Modules\Leagues\Models\League;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Fixture extends Model
{
    use HasSlug, SoftDeletes, NodeTrait;

    protected $table = 'fixtures';


    protected $fillable = [
        'title', 'slug', 'homeTeam', 'enemyTeam', 'date', 'homeTeamScore', 'awayTeamScore', 'homeTeamOdds', 'awayTeamOdds', 'drawOdds', 'visible'
    ];

    protected $casts = [
        'visible' => 'boolean',
        'homeTeamOdds' => 'float',
        'awayTeamOdds' => 'float',
        'drawOdds' => 'float',
        'date' => 'date',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug')->doNotGenerateSlugsOnUpdate();
    }

    public function league() {
        return $this->hasOne(League::class, 'api_id', 'league_api_id');
    }
}
