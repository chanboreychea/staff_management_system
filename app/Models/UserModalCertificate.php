<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModalCertificate extends Model
{
    use HasFactory;

    protected $table="user_modal_certificate_of_appreciation";
    
    protected $primaryKey="id";
    
    protected $fillable=[
    
        'using_user_id',
    
        'status',
    
        'economy',
    
        'type',
    
        'decription',
    
        'document',
    
        'date'
    ];
}
