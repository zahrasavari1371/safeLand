<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    protected $fillable=['inspection_request_id','user_id','comment'];

    public function inspectionTest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(InspectionTest::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
