<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalPositionCurrentJob extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table="user_additional_position_on_current_job";
    protected $primaryKey="id";
    protected $fillable=[
        'using_user_id',

        'date',

        'position',

        'equivalent',

        'economy',

        'document',              
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "additionalPositionId");
    }
}
