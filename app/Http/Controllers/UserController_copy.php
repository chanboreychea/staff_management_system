<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Enum\RoleUnit;
use App\Models\Office;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User_Infromation;

class UserController extends Controller
{

    public function index()
    {
        // $agent = new Agent();
        // $device = $agent->device();
        $this->setAttendances();

        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::select()->orderBy('id', 'desc')->get();
        $departments = Department::all();
        $offices = Office::all();

        return view('admin.user.create', compact('roles', 'offices', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'roleId' => ['required', Rule::exists('roles', 'id')],
                'firstNameKh' => ['bail', 'required', 'max:100'],
                'lastNameKh' => ['bail', 'required', 'max:100'],
                'departmentId' => ['nullable', Rule::exists('departments', 'id')],
                'officeId' => ['nullable', Rule::exists('offices', 'id')],
                'email' => ['bail', 'required', 'email', Rule::unique('users', 'email')],
                'password' => ['bail', 'required', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
                'phoneNumber' => ['bail', 'required', Rule::unique('users', 'phoneNumber')],
                'idCard' => ['bail', 'required', Rule::unique('users', 'idCard')],
                'dateOfBirth' => ['bail', 'required', 'date', 'before:' . now()->subYears(18)->addDays(1)->format('Y-m-d')],
                'nationality' => ['required', 'max:100'],
                'pobAddress' => ['bail', 'required', 'max:255'],
                'currentAddress' => ['bail', 'required', 'max:255'],
                'img' => 'required',
            ],
            [
                'roleId.exists' => 'ឈ្មោះតួនាទីមិនត្រឹមត្រូវ',
                'firstNameKh.required' => 'សូមបញ្ចូលនាមខ្លួន',
                'firstNameKh.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
                'lastNameKh.required' => 'សូមបញ្ចូលគោត្តនាម',
                'lastNameKh.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
                'officeId.exists' => 'ឈ្មោះការិយាល័យមិនត្រឹមត្រូវ',
                'departmentId.exists' => 'ឈ្មោះនាយកដ្ឋានមិនត្រឹមត្រូវ',
                'email.required' => 'សូមបញ្ចូលអ៊ីម៉ែលរបស់អ្នក',
                'email.unique' => 'អ៊ីម៉ែលមានរួចហើយ',
                'password.required' => 'សូមបញ្ចូលលេខសម្ងាត់',
                'phoneNumber.required' => 'សូមបញ្ចូលលេខទូរស័ព្ទ',
                'phoneNumber.unique' => 'លេខទូរស័ព្ទមានរួចហើយ',
                'idCard.required' => 'សូមបញ្ចូលអត្តលេខ',
                'idCard.unique' => 'អត្តលេខមានរួចហើយ',
                'nationality.required' => 'សូមបញ្ចូលសញ្ជាតិ',
                'nationality.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
                'pobAddress.required' => 'សូមបញ្ចូលទីកន្លែងកំណើត',
                'pobAddress.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥​ តួរ',
                'currentAddress.required' => 'សូមបញ្ចូលទីកន្លែងបច្ចុប្បន្ន',
                'currentAddress.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥ តួរ',
                'dateOfBirth.required' => 'សូមបញ្ចូលថ្ងៃខែឆ្នាំកំណើត',
                'dateOfBirth.before' => 'អាយុរបស់អ្នកត្រូវលើស​ ១៨ ឆ្នាំ',
                'img.required' => 'សូមបញ្ចូលរូបភាព',
            ]
        );


        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extenstion = $file->getClientOriginalExtension();
            $filename = Str::random(30) . '.' . strval($extenstion);
            $file->move('images/', $filename);
        }

        $user = new User();

        $roleId = $request->input('roleId');
        $user->roleId = $roleId;

        $role = DB::table('roles')->where('id', '=', $roleId)->first();
        if ($role->roleNameKh == RoleUnit::HEAD_OF_UNIT || $role->roleNameKh == RoleUnit::DEPUTY_HEAD_OF_UNIT) {

            $user->departmentId = null;
            $user->officeId = null;
        } else if ($role->roleNameKh == RoleUnit::DIRECTOR_OF_DEPARTMENT || $role->roleNameKh == RoleUnit::DEPUTY_DIRECTOR_OF_DEPARTMENT) {
            $user->departmentId = $request->input('departmentId');
            $user->officeId = null;
        } else {
            $officeId = $request->input('officeId');
            $department = DB::table('offices')->where('id', '=', $officeId)->first();
            $user->departmentId = $department->departmentId;
            $user->officeId = $officeId;
        }

        $user->firstNameKh = $request->input('firstNameKh');
        $user->lastNameKh = $request->input('lastNameKh');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'), ['rounds' => 12]);
        $user->phoneNumber = $request->input('phoneNumber');
        $user->idCard = $request->input('idCard');
        $user->dateOfBirth = $request->input('dateOfBirth');
        $user->status = $request->input('status');
        $user->nationality = $request->input('nationality');
        $user->pobAddress = $request->input('pobAddress');
        $user->currentAddress = $request->input('currentAddress');
        $user->image = $filename;
        $user->save();
        return redirect('/users');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = DB::table('roles')->select('id', 'roleNameKh')->where('id', '!=', $user->roleId)->orderBy('id', 'desc')->get();
        $queryOffices = Office::select('id', 'officeNameKh');
        $queryDepartments = Department::select('id', 'departmentNameKh');

        if ($user->departmentId != null) {
            $queryDepartments->where('id', '!=', $user->departmentId);
        }
        if ($user->officeId != null) {
            $queryOffices->where('id', '!=', $user->officeId);
        }

        $offices = $queryOffices->get();
        $departments = $queryDepartments->get();

        $user_information = User_Infromation::where('using_user_id', $id)->first();

        return view('admin.user.edit', compact('user', 'roles', 'departments', 'offices'))->with('user_information',$user_information);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate(
            [
                'firstNameKh' => ['bail', 'required', 'max:100'],
                'lastNameKh' => ['bail', 'required', 'max:100'],
                'email' => ['bail', 'required', 'email', Rule::unique('users', 'email')->whereNot('id', $id)],
                'password' => ['bail', 'required', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
                'phoneNumber' => ['bail', 'required', Rule::unique('users', 'phoneNumber')->whereNot('id', $id)],
                'idCard' => ['bail', 'required', Rule::unique('users', 'idCard')->whereNot('id', $id)],
                'dateOfBirth' => ['bail', 'required', 'date', 'before:' . now()->subYears(18)->addDays(1)->format('Y-m-d')],
                'nationality' => ['required', 'max:100'],
                'pobAddress' => ['bail', 'required', 'max:255'],
                'currentAddress' => ['bail', 'required', 'max:255'],
                'img' => [
                    'nullable',
                    'mimes:jpg,jpeg,png'
                ],
            ],
            [
                'firstNameKh.required' => 'សូមបញ្ចូលនាមខ្លួន',
                'firstNameKh.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
                'lastNameKh.required' => 'សូមបញ្ចូលនាមជីតា',
                'lastNameKh.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
                'email.required' => 'សូមបញ្ចូលអ៊ីម៉ែលរបស់អ្នក',
                'email.unique' => 'អ៊ីម៉ែលមានរួចហើយ',
                'password.required' => 'សូមបញ្ចូលលេខសម្ងាត់',
                'password.min' => 'សូមបញ្ចូលលេខសម្ងាត់យ៉ាងតិច ៨ ខ្ទង់',
                'phoneNumber.required' => 'សូមបញ្ចូលលេខទូរស័ព្ទ',
                'phoneNumber.unique' => 'លេខទូរស័ព្ទមានរួចហើយ',
                'idCard.required' => 'សូមបញ្ចូលអត្តលេខ',
                'idCard.unique' => 'អត្តលេខមានរួចហើយ',
                'nationality.required' => 'សូមបញ្ចូលសញ្ជាតិ',
                'nationality.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ១០០​ តួរ',
                'pobAddress.required' => 'សូមបញ្ចូលទីកន្លែងកំណើត',
                'pobAddress.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥​ តួរ',
                'currentAddress.required' => 'សូមបញ្ចូលទីកន្លែងបច្ចុប្បន្ន',
                'currentAddress.max' => 'អក្សរអនុញ្ញាតត្រឹម​ ២៥៥ តួរ',
                'dateOfBirth.required' => 'សូមបញ្ចូលថ្ងៃខែឆ្នាំកំណើត',
                'dateOfBirth.before' => 'អាយុរបស់អ្នកត្រូវលើស​ ១៨ ឆ្នាំ',
                'img.required' => 'សូមបញ្ចូលរូបភាព',
            ]
        );

        //img
        if ($request->hasFile('img')) {

            if ($user->image) {
                //find iamge file in public/images directory
                if (file_exists(public_path('images/' . $user->image)))
                    unlink('images/' . $user->image);
            }

            $file = $request->file('img');
            $extenstion = $file->getClientOriginalExtension();
            $filename = Str::random(30) . '.' . strval($extenstion);
            $file->move('images/', $filename);
            // 'upload image and delete old image'
            $user->image = $filename;
        }
        //password
        if ($request->input('password') != $user->password) {
            $user->password = Hash::make($request->input('password'), ['rounds' => 12]);
        }

        $roleId = $request->input('roleId');
        $user->roleId = $roleId;

        $role = DB::table('roles')->where('id', '=', $roleId)->first();
        if ($role->roleNameKh == RoleUnit::HEAD_OF_UNIT || $role->roleNameKh == RoleUnit::DEPUTY_HEAD_OF_UNIT) {
            $user->departmentId = null;
            $user->officeId = null;
        } else if ($role->roleNameKh == RoleUnit::DIRECTOR_OF_DEPARTMENT || $role->roleNameKh == RoleUnit::DEPUTY_DIRECTOR_OF_DEPARTMENT) {
            $user->departmentId = $request->input('departmentId');
            $user->officeId = null;
        } else {
            $officeId = $request->input('officeId');
            $department = DB::table('offices')->where('id', '=', $officeId)->first();
            $user->departmentId = $department->departmentId;
            $user->officeId = $officeId;
        }

        $user->firstNameKh = $request->input('firstNameKh');
        $user->lastNameKh = $request->input('lastNameKh');
        $user->gender = $request->input('gender');
        $user->email = $request->input('email');
        $user->phoneNumber = $request->input('phoneNumber');
        $user->idCard = $request->input('idCard');
        $user->dateOfBirth = $request->input('dateOfBirth');
        $user->status = $request->input('status');
        $user->nationality = $request->input('nationality');
        $user->pobAddress = $request->input('pobAddress');
        $user->currentAddress = $request->input('currentAddress');
        $user->save();
        return redirect('/users');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->image) {
            unlink('images/' . $user->image);
        }

        $user->delete();

        return redirect('/users');
    }
    // public function user_information($id=null,Request $request){
    //     $id=$id;

    //     $user_information = User_Infromation::where('using_user_id', $id)->first();
     
    //     if($user_information ){
        
    //         // return view('admin.user.user_information',compact('id'))->with('user_information',$user_information);
    //         return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');

        
    //     }else{
        
    //         // return view('admin.user.user_information',compact('id'));
    //         return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');

        
    //     }

     
    // }
    public function add_user_infromation(Request $request){
        
       
        $form_validation= $request->validate(

            [
                'constitution'                                  => ['bail', 'required'],
                
                'position_enteing_public_service'               => ['bail', 'required'],
                
                'ministry_enteing_public_service'               => ['bail', 'required'],
                
                'office_enteing_public_service'                 => ['bail', 'required'],
                
                'economy_enteing_public_service'                => ['bail', 'required'],
                
                'date_enteing_public_service'                   => ['bail', 'required'],
                
                'constitution'                                  => ['bail', 'required'],

                'position_enteing_public_service'               => ['bail', 'required'],

                'ministry_enteing_public_service'               => ['bail', 'required'],

                'economy_enteing_public_service'                => ['bail', 'required'],

                'office_enteing_public_service'                 => ['bail', 'required'],

                'constitution_misitry_rank'                     => ['bail', 'required'],

                'constitution_amendment_date'                   => ['bail', 'required'],

                'position_current_job_situation'                => ['bail', 'required'],

                'effective_date_of_last_promotion'              => ['bail', 'required'],

                'economy_current_job_situation'                 => ['bail', 'required'],
                
                'date_additional_position_on_current_job'       => ['bail', 'required'],

                'position_additional_position_on_current_job'   => ['bail', 'required'],

                'equivalent'                                    => ['bail', 'required'],

                'economy_additional_position_on_current_job'    => ['bail', 'required'],
               
                'document'                                      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

                   
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
       
     
        if($form_validation==true){

            if ($image = $request->file('document')) {
           
                $destinationPath = 'documents/';
            
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            
                $image->move($destinationPath, $profileImage);
            
                $data['document'] = $profileImage; // Store only the filename
              
            }
            
            $data = [
                
                'using_user_id'                                 => intval($request->input('using_user_id')),
                
                'constitution'                                  => $request->input('constitution'),
                
                'position_enteing_public_service'               => $request->input('position_enteing_public_service'),
                
                'ministry_enteing_public_service'               => $request->input('ministry_enteing_public_service'),
                
                'office_enteing_public_service'                 => $request->input('office_enteing_public_service'),
                
                'economy_enteing_public_service'                => $request->input('economy_enteing_public_service'),
                
                'date_enteing_public_service'                   => $request->input('date_enteing_public_service'),
                
                'comfirm_date'                                  => $request->input('comfirm_date'),
                
                'constitution_misitry_rank'                     => $request->input('constitution_misitry_rank'),
                
                'constitution_amendment_date'                   => $request->input('constitution_amendment_date'),
                
                'effective_date_of_last_promotion'              => $request->input('effective_date_of_last_promotion'),
                
                'position_current_job_situation'                => $request->input('position_current_job_situation'),
                
                'economy_current_job_situation'                 => $request->input('economy_current_job_situation'),
                
                'date_additional_position_on_current_job'       => $request->input('date_additional_position_on_current_job'),
                
                'position_additional_position_on_current_job'   => $request->input('position_additional_position_on_current_job'),
                
                'equivalent'                                    => $request->input('equivalent'),
                
                'economy_additional_position_on_current_job'    => $request->input('economy_additional_position_on_current_job'),
                
                'document'                                      =>$profileImage

            ];
            
            $id=intval($request->input("using_user_id"));
            
            $user_information = User_Infromation::where('using_user_id', $id)->first();

            if($user_information ){

                $result=$user_information->update($data);
                
            }else{

                $result=User_Infromation::create($data);
        
            }
           
            // return redirect()->route('user_information', ['id' => $id])->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');
            return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');
       
        }
       
    }

  

    public function user_work_history(){
        return view('admin.user.user_work_history');
    }
    public function user_medal_certificate_of_application(){
        return view('admin.user.user_medal_certificate_of_application');
    }
    public function user_general_education_level_vacational_and_continuing_education(){
        return view('admin.user.user_general_education_level_vacational_and_continuing_education');
    }
    public function user_foreign_language_ability(){
        return view('admin.user.user_foreign_language_ability');
    }
    public function user_family_status(){
        return view('admin.user.user_family_status');
    }
    
    // function set_data_update_additional(Request $request){

    //     $set_data_update_additional = [
    //         'date_additional_position_on_current_job' => $request->input('date_additional_position_on_current_job'),
    //         'position_additional_position_on_current_job' => $request->input('position_additional_position_on_current_job'),
    //         'equivalent' => $request->input('equivalent'),
    //         'economy_additional_position_on_current_job' => $request->input('economy_additional_position_on_current_job'),
    //         'old_document' => $request->input('old_document'),
    //         'document' => $request->hasFile('document') ? $request->file('document') : [],
    //         'additional_current_job_id' => $request->input('additional_current_job_id'),
    //     ];
    
    //     if (isset($set_data_update_additional['additional_current_job_id']) && is_array($set_data_update_additional['additional_current_job_id'])) {
    //         foreach ($set_data_update_additional['additional_current_job_id'] as $index => $currentJobId) {
    //             $additional_current_job = AdditionalPositionCurrentJob::find($currentJobId);
                
    //             if ($additional_current_job) {
    //                 $documentPath = isset($set_data_update_additional['document'][$index]) ? $set_data_update_additional['document'][$index] : null;
                    
    //                 // Check if a new file was uploaded
    //                 if ($documentPath) {
    //                     $destinationPath = 'documents/';
    //                     $profileImage = uniqid(). "." . $documentPath->getClientOriginalExtension();
    //                     $documentPath->move($destinationPath, $profileImage);
    //                     $documentPath = $profileImage;
    //                 } else {
    //                     // Use the old document path if available
    //                     $documentPath = isset($set_data_update_additional['old_document'][$index]) ? $set_data_update_additional['old_document'][$index] : 'default.png';
    //                 }
    
    //                 $additional_current_job->update([
    //                     'position' => $set_data_update_additional['position_additional_position_on_current_job'][$index],
    //                     'equivalent' => $set_data_update_additional['equivalent'][$index],
    //                     'economy' => $set_data_update_additional['economy_additional_position_on_current_job'][$index],
    //                     'document' => $documentPath,
    //                     'date' => $set_data_update_additional['date_additional_position_on_current_job'][$index]
    //                 ]);
    //             }
    //         }
    //     }
    //     return $set_data_update_additional;
    // }
    


    // function set_data_additional(Request $request, $id = null) {
      
    //     $documentPaths1 = [];
      
    //     if ($request->hasFile('document1')) {
      
    //         foreach ($request->file('document1') as $file) {
      
    //             $destinationPath = 'documents/';
      
    //             $profileImage = uniqid(). "." . $file->getClientOriginalExtension();
      
    //             $file->move($destinationPath, $profileImage);
      
    //             $documentPaths1[] = $profileImage; // Store the file path for document1
      
    //         }
      
    //     }
      
    //     $set_data_additional = [

    //         'using_user_id' => $id,

    //         'date_additional_position_on_current_job' => $request->input('date_additional_position_on_current_job1'),

    //         'position_additional_position_on_current_job' => $request->input('position_additional_position_on_current_job1'),

    //         'equivalent' => $request->input('equivalent1'),

    //         'document'=>$documentPaths1,

    //         'economy_additional_position_on_current_job' => $request->input('economy_additional_position_on_current_job1'),
    //     ];
    //     if(isset($set_data_additional['date_additional_position_on_current_job']) && is_array($set_data_additional['date_additional_position_on_current_job'])) {
    //         for ($i = 0; $i < count($set_data_additional['date_additional_position_on_current_job']); $i++) {
    //             // echo '<pre>';
    //             // var_dump(  $additional_current_job);
    //                 AdditionalPositionCurrentJob::create([

    //                     'using_user_id'=>$set_data_additional['using_user_id'],
                        
    //                     'position' => $set_data_additional['position_additional_position_on_current_job'][$i],
                        
    //                     'equivalent' => $set_data_additional['equivalent'][$i],
                        
    //                     'economy' => $set_data_additional['economy_additional_position_on_current_job'][$i],
                        
    //                     'document' => isset($set_data_additional['document'][$i]) ? $set_data_additional['document'][$i] : 'default.png',

    //                     'date'=>$set_data_additional['date_additional_position_on_current_job'][$i]

    //                 ]);
    //             }
    //     }
    //     return $set_data_additional;
    // }
    

    // public function add_user_infromation(Request $request){
        
       
    //     $form_validation= $request->validate(

    //         [
    //             'constitution'                                  => ['bail', 'required'],
                
    //             'position_enteing_public_service'               => ['bail', 'required'],
                
    //             'ministry_enteing_public_service'               => ['bail', 'required'],
                
    //             'office_enteing_public_service'                 => ['bail', 'required'],
                
    //             'economy_enteing_public_service'                => ['bail', 'required'],
                
    //             'date_enteing_public_service'                   => ['bail', 'required'],
                
    //             'constitution'                                  => ['bail', 'required'],

    //             'position_enteing_public_service'               => ['bail', 'required'],

    //             'ministry_enteing_public_service'               => ['bail', 'required'],

    //             'economy_enteing_public_service'                => ['bail', 'required'],

    //             'office_enteing_public_service'                 => ['bail', 'required'],

    //             'constitution_misitry_rank'                     => ['bail', 'required'],

    //             'constitution_amendment_date'                   => ['bail', 'required'],

    //             'position_current_job_situation'                => ['bail', 'required'],

    //             'effective_date_of_last_promotion'              => ['bail', 'required'],

    //             'economy_current_job_situation'                 => ['bail', 'required'],
                
    //             // 'date_additional_position_on_current_job'       => ['bail', 'required'],

    //             // 'position_additional_position_on_current_job'   => ['bail', 'required'],

    //             // 'equivalent'                                    => ['bail', 'required'],

    //             // 'economy_additional_position_on_current_job'    => ['bail', 'required'],
    //             // 'date_additional_position_on_current_job.*'     => ['bail', 'required'],

    //             // 'position_additional_position_on_current_job.*' => ['bail', 'required'],
                
    //             // 'equivalent.*'                                  => ['bail', 'required'],
                
    //             // 'economy_additional_position_on_current_job.*'  => ['bail', 'required'],
               
    //             // 'document.*'                                      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

                   
    //         ],
    //         [
    //             'constitution.required'                      =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

    //             'position_enteing_public_service.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

    //             'ministry_enteing_public_service.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

    //             'office_enteing_public_service.required'     =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

    //             'economy_enteing_public_service.required'    =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

    //             'date_enteing_public_service.required'       =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

    //             'comfirm_date.required'                      =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

    //         ]
    //     );
       
     
    //     if($form_validation==true){

    //         $id=intval($request->input("using_user_id"));

    //         $data = [
                
    //             'using_user_id'                                 => intval($request->input("using_user_id")),
                
    //             'constitution'                                  => $request->input("constitution"),
                
    //             'position_enteing_public_service'               => $request->input("position_enteing_public_service"),
                
    //             'ministry_enteing_public_service'               => $request->input('ministry_enteing_public_service'),
                
    //             'office_enteing_public_service'                 => $request->input('office_enteing_public_service'),
                
    //             'economy_enteing_public_service'                => $request->input('economy_enteing_public_service'),
                
    //             'date_enteing_public_service'                   => $request->input('date_enteing_public_service'),
                
    //             'comfirm_date'                                  => $request->input('comfirm_date'),
                
    //             'constitution_misitry_rank'                     => $request->input('constitution_misitry_rank'),
                
    //             'constitution_amendment_date'                   => $request->input('constitution_amendment_date'),
                
    //             'effective_date_of_last_promotion'              => $request->input('effective_date_of_last_promotion'),
                
    //             'position_current_job_situation'                => $request->input('position_current_job_situation'),
                
    //             'economy_current_job_situation'                 => $request->input('economy_current_job_situation'),
                
    //             // 'equivalent'                                    =>serialize($request->input('equivalent')),
                
    //             // // 'date_additional_position_on_current_job' => serialize($formattedDates),

    //             // 'position_additional_position_on_current_job'   => serialize($request->input('position_additional_position_on_current_job')),
                
    //             // 'economy_additional_position_on_current_job'    => serialize($request->input('economy_additional_position_on_current_job')),
                
    //             // 'document'                                      => serialize($documentPaths)

    //         ];
    //         // if ($request->hasFile('document1')) {
             
    //         //     foreach ($request->file('document1') as $file) {
             
    //         //         $destinationPath = 'documents/';
             
    //         //         $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
             
    //         //         $file->move($destinationPath, $profileImage);
             
    //         //         $documentPaths[] = $profileImage; // Store the file path
    //         //     }
    //         // }
           
          
    //         // ----------------------Update multiple Multiple addidtional on current job-----------------------------
    //         $set_data_update_additional = $this->set_data_update_additional($request);
           
          
    //     //    ------------------------insert Multiple addidtional on current job -----------------------------------
    //         $set_data_additional = $this->set_data_additional($request,$id);
            
            
            
    //         $user_information = User_Infromation::where('using_user_id', $id)->first();

    //         if($user_information ){

    //             $result=$user_information->update($data);
                
    //         }else{

    //             $result=User_Infromation::create($data);
        
    //         }
          
          
            
        



            
    //         // Initialize array to hold file paths
    //         // $documentPaths = [];
            
    //         // Loop through each file input
    //         // foreach ($request->file('document') as $key => $file) {
    //         //     if ($file) {
    //         //         // If a file is uploaded for the current key
    //         //         $destinationPath = 'documents/';
    //         //         $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
    //         //         $file->move($destinationPath, $profileImage);
    //         //         $documentPaths[$key] = $profileImage; // Store the file path
    //         //     } else {
    //         //         // If no file uploaded, set default image or empty value
    //         //         $documentPaths[$key] = 'default_image.png'; // Set a default image or use an empty string
    //         //     }
    //         // }
            
            
    //         // Loop through the data and store in the database
        
    //         // if($count!=0&&!empty($count)){

           
    //         //     for ($i = 0; $i < count($date_additional_position_on_current_job); $i++) {
                    
    //         //         $additional_current_job=AdditionalPositionCurrentJob::where('id',$request->input('additional_current_job_id')[$i]);

    //         //         if($additional_current_job){

    //         //             $additional_current_job->update([
    //         //                 'using_user_id' => $id,
                    
    //         //                 'date' => $date_additional_position_on_current_job[$i],
                        
    //         //                 'position' => $position_additional_position_on_current_job[$i],
                        
    //         //                 'equivalent' => $equivalent[$i],
                        
    //         //                 'economy' => $economy_additional_position_on_current_job[$i],
                        
    //         //                 'document' =>   $old_document[$i] //
    //         //             ]);
    //         //         }else{
    //         //             AdditionalPositionCurrentJob::create([
                    
    //         //                 'using_user_id' => $id,
                        
    //         //                 'date' => $date_additional_position_on_current_job[$i],
                        
    //         //                 'position' => $position_additional_position_on_current_job[$i],
                        
    //         //                 'equivalent' => $equivalent[$i],
                        
    //         //                 'economy' => $economy_additional_position_on_current_job[$i],
                        
    //         //                 'document' => isset($documentPaths[$i]) ? $documentPaths[$i] : null // Use the document path if it exists, otherwise null
                        
    //         //             ]);
    //         //         }
                 
                
    //         //     }
    //         // }
  
           
    //         // return redirect()->route('user_information', ['id' => $id])->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');
    //         return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');
       
    //     }
    //     else{
    //         return redirect()->back();
    //     }
       
    // }


   
}
