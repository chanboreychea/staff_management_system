<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAbilityLanguage extends Model
{
    use HasFactory;

    protected $table="user_language_skills";
    
    protected $primaryKey="id";
    
    protected $fillable=[
    
        'using_user_id',
    
        'language',
    
        'read',
    
        'write',
        
        'speak',

        'listen',
       
    ];
}
