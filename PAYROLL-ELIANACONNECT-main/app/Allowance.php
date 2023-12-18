<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Allowance extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'slug',
        'security_number'
    ];
    
    protected $casts = [
        'amount' => 'float',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = ucwords($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
