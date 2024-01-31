<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';
    protected $fillable = [
        'departmentId',
        'officeNameKh',
        'description',
        'active'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'departmentId');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "officeId");
    }
}
