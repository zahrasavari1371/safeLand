<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table='companies';
    protected $fillable=['name','logo'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function companyUnits()
    {
        return $this->hasMany(CompanyUnit::class);
    }
}
