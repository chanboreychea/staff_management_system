<?php

namespace App\Http\Controllers;

use App\Models\User_Infromation;
use Illuminate\Http\Request;

class UserInfromationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id=null)
    {
        $id=$id;
       
        return view('admin.user.user_information',compact('id'));
    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
          
        $form_validation= $request->validate(

            [
                'constitution'                    => ['bail', 'required'],
                
                'position_enteing_public_service' => ['bail', 'required'],
                
                'ministry_enteing_public_service' => ['bail', 'required'],
                
                'office_enteing_public_service'   => ['bail', 'required'],
                
                'economy_enteing_public_service'  => ['bail', 'required'],
                
                'date_enteing_public_service'     =>['bail', 'required'],
                
                'comfirm_date'                    => ['bail', 'required'],
                   
            ],
            [
                'constitution.required'                      =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'position_enteing_public_service.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'ministry_enteing_public_service.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'office_enteing_public_service.required'     =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'economy_enteing_public_service.required'    =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'date_enteing_public_service.required'       =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'comfirm_date.required'                      =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            ]
        );
        // var_dump(   $file=$request->file('document'));
        if($request->hasfile('document')){

            $file=$request->file('document');

            $extenstion=$file->getClientOriginalExtension();

            $filename = Str::random(30) . '.' . strval($extenstion);

            $file->move('users/',$filename);

            // var_dump($filename);
            // die;
        }
     

       if($form_validation==true){

        

            $data=[

                'using_user_id'                                 =>$request->input('using_user_id'),

                'constitution'                                  =>$request->input('constitution'),
                
                'position_enteing_public_service'               =>$request->input('position_enteing_public_service'),

                'office_enteing_public_service'                 =>$request->input('office_enteing_public_service'),

                'economy_enteing_public_service'                =>$request->input('economy_enteing_public_service'),

                'date_enteing_public_service'                   =>$request->input('date_enteing_public_service'),

                'comfirm_date'                                  =>$request->input('comfirm_date'),

                'constitution_misitry_rank'                     =>$request->input('constitution_misitry_rank'),

                'constitution_amendment_date'                   =>$request->input('constitution_amendment_date'),
                
                'effective_date_of_last_promotion'              =>$request->input('effective_date_of_last_promotion'),
                
                'position_current_job_situation'                =>$request->input('position_current_job_situation'),

                'economy_current_job_situation'                 =>$request->input('economy_current_job_situation'),

                'date_additional_position_on_current_job'       =>$request->input('date_additional_position_on_current_job'),

                'position_additional_position_on_current_job'   =>$request->input('date_additional_position_on_current_job'),

                'equivalent'                                    =>$request->input('equivalent'),

                'economy_additional_position_on_current_job'    =>$request->input('economy_additional_position_on_current_job'),

                'document'                                      =>$filename

            ];
        
        // $result=User_Infromation::create($data); 



           
        echo "<pre>";
        var_dump($data);
        die();
       }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User_Infromation $user_Infromation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User_Infromation $user_Infromation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User_Infromation $user_Infromation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User_Infromation $user_Infromation)
    {
        //
    }

    public function user_information($id=null,Request $request){
        $id=$id;
       
        return view('admin.user.user_information',compact('id'));
    }

    public function add_user_infromation(Request $request){
        
        $form_validation= $request->validate(

            [
                'constitution'                    => ['bail', 'required'],
                
                'position_enteing_public_service' => ['bail', 'required'],
                
                'ministry_enteing_public_service' => ['bail', 'required'],
                
                'office_enteing_public_service'   => ['bail', 'required'],
                
                'economy_enteing_public_service'  => ['bail', 'required'],
                
                'date_enteing_public_service'     =>['bail', 'required'],
                
                'comfirm_date'                    => ['bail', 'required'],
                   
            ],
            [
                'constitution.required'                      =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'position_enteing_public_service.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'ministry_enteing_public_service.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'office_enteing_public_service.required'     =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'economy_enteing_public_service.required'    =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'date_enteing_public_service.required'       =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                'comfirm_date.required'                      =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            ]
        );
        if($request->hasfile('document')){

            $file=$request->file('document');

            $extenstion=$file->getClientOriginalExtension();

            $filename = Str::random(30) . '.' . strval($extenstion);

            $file->move('users/',$filename);

        }
        var_dump($filename);
        die;

       if($form_validation==true){

        

            $data=[

                'using_user_id'                                 =>$request->input('using_user_id'),

                'constitution'                                  =>$request->input('constitution'),
                
                'position_enteing_public_service'               =>$request->input('position_enteing_public_service'),

                'office_enteing_public_service'                 =>$request->input('office_enteing_public_service'),

                'economy_enteing_public_service'                =>$request->input('economy_enteing_public_service'),

                'date_enteing_public_service'                   =>$request->input('date_enteing_public_service'),

                'comfirm_date'                                  =>$request->input('comfirm_date'),

                'constitution_misitry_rank'                     =>$request->input('constitution_misitry_rank'),

                'constitution_amendment_date'                   =>$request->input('constitution_amendment_date'),
                
                'effective_date_of_last_promotion'              =>$request->input('effective_date_of_last_promotion'),
                
                'position_current_job_situation'                =>$request->input('position_current_job_situation'),

                'economy_current_job_situation'                 =>$request->input('economy_current_job_situation'),

                'date_additional_position_on_current_job'       =>$request->input('date_additional_position_on_current_job'),

                'position_additional_position_on_current_job'   =>$request->input('date_additional_position_on_current_job'),

                'equivalent'                                    =>$request->input('equivalent'),

                'economy_additional_position_on_current_job'    =>$request->input('economy_additional_position_on_current_job'),

                // 'document'                                      =>$filename

            ];
        
        $result=User_Infromation::create($data); 



           
        echo "<pre>";
        var_dump($result);
        die();
       }
       
    }
  
    // public function user_work_history(){
    //     return view('admin.user.user_work_history');
    // }
    // public function user_medal_certificate_of_application(){
    //     return view('admin.user.user_medal_certificate_of_application');
    // }
    // public function user_general_education_level_vacational_and_continuing_education(){
    //     return view('admin.user.user_general_education_level_vacational_and_continuing_education');
    // }
    // public function user_foreign_language_ability(){
    //     return view('admin.user.user_foreign_language_ability');
    // }
    // public function user_family_status(){
    //     return view('admin.user.user_family_status');
    // }
}
