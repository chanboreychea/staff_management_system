<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
        'departmentNameKh',
        'description',
        'active',
    ];

    public function offices(): HasMany
    {
        return $this->hasMany(Office::class, "departmentId");
    }
}
