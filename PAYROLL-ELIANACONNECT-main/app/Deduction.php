<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Deduction extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'slug',
        'security_number',
        'deduction_code',
        'description',
        'employee_id',
        'start_date',
        'end_date'
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

    public function setStartDateAttribute($value){
        $this->attributes['start_date'] = date('Y-m-d',strtotime($value));
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
