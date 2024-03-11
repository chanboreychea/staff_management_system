<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWoringHistoryPrivateSetor extends Model
{
    use HasFactory;

    protected $table="user_working_histroy_private_sectors";
    
    protected $primaryKey="id";
    
    protected $fillable=[
    
        'using_user_id',
    
        'tecnology',
    
        'economy',
    
        'position',
    
        'other',
    
        'start_date',
    
        'end_date'
    ];
}
