<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackUsers extends Model
{
    use HasFactory;
  protected $fillable = [
        'countryName',
        'countryCode',
        'regionCode',
        'regionName',
        'latitude',
        'longitude',
        'ip',
       
    ];
    
    
    
    public function getCountryCodeAttribute(){
        return strtolower($this->attributes['countryCode']);
    }

  
  
}
