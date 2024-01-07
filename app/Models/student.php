<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis', 
        'name',
        'rombel_id',
        'rayon_id'
    ];

    public function rayon(): belongsTo
    {
        return $this->belongsTo(rayon::class);
    }

    public function rombel(): belongsTo
    {
        return $this->belongsTo(rombel::class);
    }

    public function late()
    {
        return $this->hasMany(late::class);
    }
}
