<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table='states';

    public function cities(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsToMany(City::class);
    }

}
