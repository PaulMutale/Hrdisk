<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'agenda',
        'security_number',
        'start_time',
        'end_time'
    ];


    public function getCreatedAtAttribute(){
        return date("M d, Y",strtotime($this->attributes['created_at']));
    }

}
