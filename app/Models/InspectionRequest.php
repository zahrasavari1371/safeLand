<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionRequest extends Model
{
    protected $table='inspection_requests';
    protected $fillable=['created_by','unit_id','manufacturer','work_order','tests','description','size','equipment_name','serial_no','location','inspection_type','irn_no','status','start_date','end_date','next_inspection_date','inspector','coordinator','coordinator_mobile','coordinator_mobile','city_id'];
    protected $casts = [
        'tests' => 'array', // Cast 'tests' as an array
    ];
    public function files(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(File::class, 'inspection_id');
    }

    public function creator(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function inspectorr(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','inspector');
    }

    public function unit(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CompanyUnit::class,'id','unit_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'inspection_request_id','id');
    }

    public function city(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(City::class,'id','city_id');
    }
}
