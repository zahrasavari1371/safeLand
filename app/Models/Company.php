<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table='companies';
    protected $fillable=['name','national_id','economic_code','registration_number','fax','office_phone','zipcode','address','city_id','logo'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function city()
    {
        return $this->hasOne(City::class,'id','city_id');
    }

    public function companyUnits()
    {
        return $this->hasMany(CompanyUnit::class);
    }
}
