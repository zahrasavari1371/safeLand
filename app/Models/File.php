<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table='files';
    protected $fillable=['inspection_id','user_id','file_path','file_name','file_type'];

    public function inspectionRequest()
    {
        return $this->belongsTo(InspectionRequest::class);
    }

}
