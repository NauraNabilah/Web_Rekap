<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class late extends Model
{
    use HasFactory;

    protected $fillable = [
     'student_id', 'date_time_late', 'information', 'bukti'
    ];

    public function student(): belongsTo
    {
        return $this->belongsTo(student::class);
    }

}
