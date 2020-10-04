<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerCertificate extends Model
{
    protected $guarded = [];
    protected $table = 'employer_certificates';

    public function certificate()
    {
        return $this->belongsTo('App\Certificate', 'certificate_id', 'id');
    }
}
