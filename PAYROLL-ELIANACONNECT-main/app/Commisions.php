<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commisions extends Model
{
    use HasFactory;
  
  protected $fillable = [
        'agent_id',
        'company_id',
        'withdraw',
        'is_approved',
        'commisions'
    ];
}
