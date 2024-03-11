<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWoringHistoryPublicSetor extends Model
{
    use HasFactory;
    
    protected $table="user_working_histroy_public_sectors";
    
    protected $primaryKey="id";
    
    protected $fillable=[
    
        'using_user_id',
    
        'ministry',
    
        'economy',
    
        'position',
    
        'other',
    
        'start_date',
    
        'end_date'
    ];
}
