<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table='tests';
    protected $fillable = ['name','short_name', 'type', 'parent_id'];

    // رابطه با والد
    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Test::class, 'parent_id');
    }

    // رابطه با زیرمجموعه‌ها
    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Test::class, 'parent_id');
    }
}
