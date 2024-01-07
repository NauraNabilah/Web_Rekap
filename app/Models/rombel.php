<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rombel extends Model
{
    use HasFactory;

    protected $fillable = [
        'rombel',
    ];

    public function student(): HasMany
    {
        return $this->HasMany(Student::class);
    }
}
