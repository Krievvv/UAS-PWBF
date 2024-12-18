<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KomentarModel extends Model
{
    protected $table = 'komentar';
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class, 'user_id');
    }
    public function komunitas(): BelongsTo
    {
        return $this->belongsTo(KomunitasModel::class, 'komunitas_id');
    }
}
