<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $fillable = [
        'userId',
        'date',
        'topicOfMeeting',
        'directedBy',
        'meetingLevel',
        'member',
        'description',
        'isApprove'
    ];

    public function roomTime(): HasMany
    {
        return $this->hasMany(RoomTime::class, "bookingId");
    }
}
