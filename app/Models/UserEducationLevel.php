<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEducationLevel extends Model
{
    use HasFactory;
    protected $table="user_education_level";
    
    protected $primaryKey="id";
    
    protected $fillable=[
    
        'using_user_id',
    
        'level',
    
        'education_intitution',
    
        'cetificate',
        
        'start_date',

        'end_date',

        'status'
    ];
}
