<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFamily extends Model
{
    use HasFactory;

    protected $table="user_families";
    
    protected $primaryKey="id";
    
    protected $fillable=[
        'using_user_id', 
        'father_name',
        'father_name_in_english', 
        'father_status',
        'father_job',
        'father_national',
        'f_current_residence', 
        'f_institute', 
        'f_address',
        'father_date',
        'mother_name',
        'mother_name_in_english', 
        'mother_status',
        'mother_job',
        'mother_national',
        'm_current_residence',
        'm_institute',
        'm_address', 
        'mother_date',
        'federation_name', 
        'federation_name_in_english',
        'federation_status',
        'federation_job', 
        'federation_national', 
        'federation_current_residence',
        'federation_institute', 
        'federation_allowance', 
        'federation_phone_number',
        'federation_date',
        'relative_name',
        'relative_name_in_english',
        'relative_gender',
        'relative_job',
        'relative_date', 
        'children_name',
        'children_name_in_english',
        'children_gender',
        'children_job',
        'children_allowance',
        'children_date',

    ];
}
