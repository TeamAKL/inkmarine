<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeer extends Model
{
    protected $guarded = [];
    protected $table = 'employeers';

    public function employeer_details()
    {
        return $this->hasOne('App\EmployeerDetail', 'employer_id');
    }
}
