<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceTest extends Model
{
    use HasFactory;
    protected $table = 'attendancetests';
    protected $fillable = [
        'userId', 'date', 'checkIn', 'checkOut', 'total'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idCard');
    }
}
