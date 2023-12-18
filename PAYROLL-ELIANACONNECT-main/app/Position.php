<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Position extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'security_number',
        'salary_scale',
        'vacancies',
        'head_count',
        'housing_allowance',
        'transport_allowance'
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function setTitleAttribute($value){
        $this->attributes['title'] = ucwords($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
