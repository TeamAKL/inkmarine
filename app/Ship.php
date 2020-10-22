<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'ship_name','ship_type','grt','kw','area','company_id',
    ];
    protected $table = "ships";
    
}
