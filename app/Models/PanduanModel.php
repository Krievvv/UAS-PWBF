<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PanduanModel extends Model
{
    protected $table = 'panduan';
    protected $guarded = [];

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
