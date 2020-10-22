<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'country',
    ];
    protected $guarded = [];
    protected $table = "companies";

}
