<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyUnit extends Model
{
    protected $table='company_units';
    protected $fillable=['name','company_id'];

    function user()
    {
        return $this->hasMany(User::class);
    }

    function company(){
        return $this->belongsTo('App\Models\Company');
    }
}
