<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Infromation extends Model
{
    use HasFactory;
    protected $table="user_information";
    protected $primaryKey="id";
    protected $fillable=[
        'using_user_id'                                ,

        'constitution'                           ,
        
        'position_enteing_public_service'             ,

        'ministry_enteing_public_service'              ,

        'office_enteing_public_service'                ,

        'economy_enteing_public_service'               ,

        'date_enteing_public_service'                ,

        'comfirm_date'                                ,

        'constitution_misitry_rank'                    ,

        'constitution_amendment_date'                  ,
        
        'effective_date_of_last_promotion'             ,
        
        'position_current_job_situation'                ,

        'economy_current_job_situation'               ,

        'date_additional_position_on_current_job'       ,

        'position_additional_position_on_current_job'  ,

        'equivalent'                                    ,

        'economy_additional_position_on_current_job',

        'document'              
    ];
}
