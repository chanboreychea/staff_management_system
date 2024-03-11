<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Enum\RoleUnit;
use App\Models\Office;
use App\Models\Department;
use App\Models\AdditionalPositionCurrentJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User_Infromation;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\UserWoringHistoryPublicSetor;
use App\Models\UserWoringHistoryPrivateSetor;
use App\Models\UserModalCertificate;
use App\Models\UserEducationLevel;
use App\Models\UserAbilityLanguage;
use Illuminate\Http\Response;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\UserFamily;


class UserController extends Controller
{

    public function index()
    {
        // $agent = new Agent();
        // $device = $agent->device();
        // $this->setAttendances();

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

        
        $AdditionalPositionCurrentJob = AdditionalPositionCurrentJob::where('using_user_id', $id)->get();


        // ->with('user_information',$user_information)
        return view('admin.user.edit', compact('user', 'roles', 'departments', 'offices'));
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

    // -----------------------------------user_form_information-----------------------------------
        function set_data_update_additional(Request $request){

            $set_data_update_additional = [


                'date_additional_position_on_current_job' => $request->input('date_additional_position_on_current_job'),
            
                'position_additional_position_on_current_job' => $request->input('position_additional_position_on_current_job'),
            
                'equivalent' => $request->input('equivalent'),
            
                'economy_additional_position_on_current_job' => $request->input('economy_additional_position_on_current_job'),
                
                'old_document' => $request->input('old_document'),
            
                'document' => $request->hasFile('document') ? $request->file('document') : [],
            
                'additional_current_job_id' => $request->input('additional_current_job_id'),
        
            ];
        
            if (isset($set_data_update_additional['additional_current_job_id']) && is_array($set_data_update_additional['additional_current_job_id'])) {
            
                foreach ($set_data_update_additional['additional_current_job_id'] as $index => $currentJobId) {
            
                    $additional_current_job = AdditionalPositionCurrentJob::find($currentJobId);
                    
                    if ($additional_current_job) {
            
                        $documentPath = isset($set_data_update_additional['document'][$index]) ? $set_data_update_additional['document'][$index] : null;
                        
                        // Check if a new file was uploaded
                        if ($documentPath) {
                
                            $destinationPath = 'documents/';
                
                            $profileImage = uniqid(). "." . $documentPath->getClientOriginalExtension();
                
                            $documentPath->move($destinationPath, $profileImage);
                
                            $documentPath = $profileImage;
            
                        } else {
                            // Use the old document path if available
            
                            $documentPath = isset($set_data_update_additional['old_document'][$index]) ? $set_data_update_additional['old_document'][$index] : 'default.png';
            
                        }
        
                        $additional_current_job->update([
                
                            'position' => $set_data_update_additional['position_additional_position_on_current_job'][$index],
                
                            'equivalent' => $set_data_update_additional['equivalent'][$index],
                
                            'economy' => $set_data_update_additional['economy_additional_position_on_current_job'][$index],
                
                            'document' => $documentPath,
            
                            'date' => $set_data_update_additional['date_additional_position_on_current_job'][$index]
        
                        ]);
                    }
                }
            }
            return $set_data_update_additional;
        }

        function set_data_additional(Request $request, $id = null) {
        
            // $documentPaths1 = [];
        
            // if ($request->hasFile('document1')) {
        
            //     foreach ($request->file('document1') as $file) {
        
            //         $destinationPath = 'documents/';
        
            //         $profileImage = uniqid(). "." . $file->getClientOriginalExtension();
        
            //         $file->move($destinationPath, $profileImage);
        
            //         $documentPaths1[] = $profileImage; // Store the file path for document1
        
            //     }
        
            // }
        
            $set_data_additional = [

                'using_user_id' => $id,

                'date_additional_position_on_current_job' => $request->input('date_additional_position_on_current_job1'),

                'position_additional_position_on_current_job' => $request->input('position_additional_position_on_current_job1'),

                'equivalent' => $request->input('equivalent1'),

                'economy_additional_position_on_current_job' => $request->input('economy_additional_position_on_current_job1'),
            ];
            if(isset($set_data_additional['date_additional_position_on_current_job']) && is_array($set_data_additional['date_additional_position_on_current_job'])) {
            
                for ($i = 0; $i < count($set_data_additional['date_additional_position_on_current_job']); $i++) {

                        $documentPath = 'default.png'; // Default document path

                        if ($request->hasFile("document1.$i")) {

                            $file = $request->file("document1.$i");

                            $destinationPath = 'documents/';

                            $profileImage = uniqid() . "." . $file->getClientOriginalExtension();

                            $file->move($destinationPath, $profileImage);

                            $documentPath =  $profileImage;

                        }
                        AdditionalPositionCurrentJob::create([

                            'using_user_id'=>$set_data_additional['using_user_id'],
                            
                            'position' => $set_data_additional['position_additional_position_on_current_job'][$i],
                            
                            'equivalent' => $set_data_additional['equivalent'][$i],
                            
                            'economy' => $set_data_additional['economy_additional_position_on_current_job'][$i],
                            
                            'document' => $documentPath,

                            'date'=>$set_data_additional['date_additional_position_on_current_job'][$i]

                        ]);
                    }
            }
            return $set_data_additional;
        }
        
        public function add_user_infromation(Request $request){
            
        
            // $form_validation= $request->validate(

            //     [
            //         'constitution'                                  => ['bail', 'required'],
                    
            //         'position_enteing_public_service'               => ['bail', 'required'],
                    
            //         'ministry_enteing_public_service'               => ['bail', 'required'],
                    
            //         'office_enteing_public_service'                 => ['bail', 'required'],
                    
            //         'economy_enteing_public_service'                => ['bail', 'required'],
                    
            //         'date_enteing_public_service'                   => ['bail', 'required'],
                    
            //         'constitution'                                  => ['bail', 'required'],

            //         'position_enteing_public_service'               => ['bail', 'required'],

            //         'ministry_enteing_public_service'               => ['bail', 'required'],

            //         'economy_enteing_public_service'                => ['bail', 'required'],

            //         'office_enteing_public_service'                 => ['bail', 'required'],

            //         'constitution_misitry_rank'                     => ['bail', 'required'],

            //         'constitution_amendment_date'                   => ['bail', 'required'],

            //         'position_current_job_situation'                => ['bail', 'required'],

            //         'effective_date_of_last_promotion'              => ['bail', 'required'],

            //         'economy_current_job_situation'                 => ['bail', 'required'],

                    
            //     ],
            //     [
            //         'constitution.required'                      =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            //         'position_enteing_public_service.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            //         'ministry_enteing_public_service.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            //         'office_enteing_public_service.required'     =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            //         'economy_enteing_public_service.required'    =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            //         'date_enteing_public_service.required'       =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            //         'comfirm_date.required'                      =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

            //     ]
            // );
        
        
            // if($form_validation==true){

                $id=intval($request->input("using_user_id"));

                $data = [
                    
                    'using_user_id'                                 => intval($request->input("using_user_id")),
                    
                    'constitution'                                  => $request->input("constitution"),
                    
                    'position_enteing_public_service'               => $request->input("position_enteing_public_service"),
                    
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
                    
                

                ];
        
            
            // ----------------------Update multiple Multiple addidtional on current job-----------------------------

                $set_data_update_additional = $this->set_data_update_additional($request,$id);
            
            
            //------------------------insert Multiple addidtional on current job -----------------------------------
                $set_data_additional = $this->set_data_additional($request,$id);
                
                
                
                $user_information = User_Infromation::where('using_user_id', $id)->first();

                if($user_information ){

                    $result=$user_information->update($data);
                    
                }else{

                    $result=User_Infromation::create($data);
            
                }
            
                return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');
        
            // }
            // else{
            //     return redirect()->back();
            // }
        
        }

        public function user_form_information($id){

        
            $AdditionalPositionCurrentJob=AdditionalPositionCurrentJob::where('using_user_id','=',$id)->get();

            $user_information=User_Infromation::where('using_user_id','=',$id)->get()->first();
        
            // // Check if the user exists
            // if ($user_information->isEmpty()) {
            
            //     $html = View::make('components.user.user_form_information', ['id'=>$id])->render();
            // }
            // $html = View::make('components.user.user_form_information', ['id'=>$id,'AdditionalPositionCurrentJob'=>$AdditionalPositionCurrentJob,'user_information'=>$user_information])->render();
            if ($user_information === null) {
                // If $user_information is empty, render the view without it
                $html = View::make('components.user.user_form_information', ['id' => $id])->render();
                
            } else {
                // If $user_information is not empty, render the view with all data
                $html = View::make('components.user.user_form_information', [
                
                    'id' => $id,
                
                    'AdditionalPositionCurrentJob' => $AdditionalPositionCurrentJob,
                
                    'user_information' => $user_information
            
                ])->render();
    
            }
            
            return response()->json(['html' => $html]);
        }
        public function detail(Request $request, $id)
        {
            $user = User::find($id);
    
            $additionalPCJ=AdditionalPositionCurrentJob::where('using_user_id','=',$id)->get();

            $userWoringHistoryPublicSetor=UserWoringHistoryPublicSetor::where('using_user_id','=',$id)->get();

            $userWoringHistoryPrivateSetor=UserWoringHistoryPrivateSetor::where('using_user_id','=',$id)->get();

            $userWoringHistoryPrivateSetor=UserWoringHistoryPrivateSetor::where('using_user_id','=',$id)->get();
            
            $userModalCertificate=UserModalCertificate::where('using_user_id','=',$id)->get();

            $userEducationLevel=UserEducationLevel::where('using_user_id','=',$id)->get();

            $userAbilityLanguage=UserAbilityLanguage::where('using_user_id','=',$id)->get();

            $user_information=User_Infromation::where('using_user_id','=',$id)->get()->first();

            $userFamily=UserFamily::where('using_user_id','=',$id)->get()->first();
    
            // Check if the user exists
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
    
            // Render the Blade component with the user data
            $html = View::make('components.user.detail', [
                
                'user' => $user,
                
                'additionalPCJ'=>$additionalPCJ,
                
                'user_information'=>$user_information,
                
                'userWoringHistoryPublicSetor'=>$userWoringHistoryPublicSetor,
                
                'userWoringHistoryPrivateSetor'=>$userWoringHistoryPrivateSetor,

                'userModalCertificate'=>$userModalCertificate,

                'userAbilityLanguage'=>$userAbilityLanguage,

                'userFamily'    =>$userFamily,

                'userEducationLevel'=>$userEducationLevel

                ])->render();
            // Return the HTML content as JSON
            return response()->json(['html' => $html]);
        }
        
        // public function generate_pdf($id){
         
        //     $html = '<html>
        //             <head>
        //                 <style>
        //                 @font-face {
        //                     font-family: "Moul";
        //                     src: url("/fonts/Moul.ttf") format("truetype");
        //                 }
        //                 .text-khmer {
        //                     font-family: "Moul", sans-serif;
        //                     text-align: center;
        //                 }
        //                 </style>
        //             </head>
        //             <body>
        //                 <h1>សួស្តី​អ្នក!</h1>
        //                 <p>សូម​ស្វាគមន៍​មកកាន់កម្មវិធី Laravel!</p>
        //             </body>
        //         </html>';
    
        //     $dompdf=new Dompdf();
            
        //     $dompdf->loadHTML($html);
            
        //     $dompdf->setPaper('A4','portrail');
    
        //     $dompdf->render();
    
        //     $pdfContent=$dompdf->output();
    
        //     // Set the response headers
        //     $headers = [
        //         'Content-Type' => 'application/pdf',
        //         'Content-Disposition' => 'attachment; filename="CV.pdf"',
        //     ];
        
        //     // Return the PDF as a downloadable file
        //     return new Response($pdfContent, 200, $headers);
    
        // }
        // public function generate_pdf($id) {

        //     $user = User::find($id);
    
        //     $additionalPCJ=AdditionalPositionCurrentJob::where('using_user_id','=',$id)->get();

        //     $userWoringHistoryPublicSetor=UserWoringHistoryPublicSetor::where('using_user_id','=',$id)->get();

        //     $userWoringHistoryPrivateSetor=UserWoringHistoryPrivateSetor::where('using_user_id','=',$id)->get();

        //     $userWoringHistoryPrivateSetor=UserWoringHistoryPrivateSetor::where('using_user_id','=',$id)->get();
            
        //     $userModalCertificate=UserModalCertificate::where('using_user_id','=',$id)->get();

        //     $userEducationLevel=UserEducationLevel::where('using_user_id','=',$id)->get();

        //     $userAbilityLanguage=UserAbilityLanguage::where('using_user_id','=',$id)->get();

        //     $user_information=User_Infromation::where('using_user_id','=',$id)->get()->first();

        //     $userFamily=UserFamily::where('using_user_id','=',$id)->get()->first();
        //     // Get the HTML content from the view
        //     $html = View::make('components.user.detail',[
        //         'user' => $user,
                
        //         'additionalPCJ'=>$additionalPCJ,
                
        //         'user_information'=>$user_information,
                
        //         'userWoringHistoryPublicSetor'=>$userWoringHistoryPublicSetor,
                
        //         'userWoringHistoryPrivateSetor'=>$userWoringHistoryPrivateSetor,

        //         'userModalCertificate'=>$userModalCertificate,

        //         'userAbilityLanguage'=>$userAbilityLanguage,

        //         'userFamily'    =>$userFamily,

        //         'userEducationLevel'=>$userEducationLevel

        //     ])->render();
        
        //     // Create a new Dompdf instance
        //     $dompdf = new Dompdf();
        
        //     // Load HTML content into Dompdf
        //     $dompdf->loadHtml($html);
        
        //     // Set paper size and orientation
        //     $dompdf->setPaper('A4', 'portrait');
        
        //     // Render PDF (generate PDF content)
        //     $dompdf->render();
        
        //     // Get the generated PDF content
        //     $pdfContent = $dompdf->output();
        
        //     // Set the response headers
        //     $headers = [
        //         'Content-Type' => 'application/pdf',
        //         'Content-Disposition' => 'attachment; filename="CV.pdf"',
        //     ];
        
        //     // Return the PDF as a downloadable file
        //     return new Response($pdfContent, 200, $headers);
        // }
    // -----------------------------------End user_form_information-------------------------
   
    // ----------------------------user_work_history-----------------------------------------
        function update_data_working_history_public_sector(Request $request) {
            // Retrieve data from the request
            $data = [
                'id' => $request->input("id"),

                'ministry'   => $request->input("ministry"),

                'economy'    => $request->input("economy"),

                'position'   => $request->input("position"),

                'other'      => $request->input('other'),

                'start_date' => $request->input('start_date'),

                'end_date'   => $request->input('end_date'),
            ];
            if (isset($data['id']) && is_array($data['id'])) {

                foreach ($data['id'] as $index => $workingHistoryPublicSectorId) {
                    // Find the UserWoringHistoryPublicSetor instance by ID
                    $userWorkingHistoryPublicSector = UserWoringHistoryPublicSetor::find($workingHistoryPublicSectorId);
                    
                    if ($userWorkingHistoryPublicSector) {              
                        // Update the instance with the provided data
                        $userWorkingHistoryPublicSector->update([
                            
                            'start_date'  => $data['start_date'][$index],
                            
                            'end_date'    => $data['end_date'][$index],
                            
                            'ministry'    => $data['ministry'][$index],
                            
                            'economy'     => $data['economy'][$index],
                            
                            'position'    => $data['position'][$index],
                            
                            'other'       => $data['other'][$index],
                        ]);
                    }
                }
            }
            // return $data;
            return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');
        }
    
        function update_data_working_history_private_sector(Request $request) {
            $data = [
            
                'ids'       => $request->input("ids"),
            
                'tecnology' => $request->input("tecnology_ps"),
                
                'economy'   => $request->input("economy_ps"),
                
                'position'  => $request->input("position_ps"),
                
                'other'     => $request->input('other_ps'),
                
                'start_date'=> $request->input('start_date_ps'),
            
                'end_date'  => $request->input('end_date_ps'),
        
            ];
        
            if(isset($data['ids']) && is_array($data['ids'])) {
            
                foreach ($data['ids'] as $index => $workingHistoryPrivateSectorId) {
                
                    $userWorkingHistoryPrivateSector = UserWoringHistoryPrivateSetor::find($workingHistoryPrivateSectorId);
                        
                    if($userWorkingHistoryPrivateSector) {              
                
                        $userWorkingHistoryPrivateSector->update([
                            
                            'start_date' => $data['start_date'][$index],
                        
                            'end_date'   => $data['end_date'][$index],
                            
                            'tecnology'  => $data['tecnology'][$index],
                            
                            'economy'    => $data['economy'][$index],
                        
                            'position'   => $data['position'][$index],
                        
                            'other'      => $data['other'][$index],
                    
                        ]);
                    }
                }
            }
                
            // return $data;
            return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');
        }
        
        function get_data_working_history_public_sector(Request $request,$id=null){
                
            $form_validation= $request->validate(

                [
                    
                    'ministry1'   => ['bail', 'required'],

                    'economy1'    => ['bail', 'required'],

                    'position1'   => ['bail', 'required'],
                    
                    'start_date1' => ['bail', 'required'],

                    'end_date1'   => ['bail', 'required'],
                    
                ],

                [
                    'ministry1.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                    'economy1.required'    =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                    'position1.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                    'start_date1.required' =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",

                    'end_date1.required'   =>"សូមធ្វើការបញ្ចូលទិន្ន័យ",


                ]
            );
            if($form_validation==true){

        

                $data = [
                        
                    'using_user_id' =>$id,
                    
                    'ministry'      => $request->input("ministry1"),
                    
                    'economy'       => $request->input("economy1"),

                    'position'      => $request->input("position1"),
                    
                    'other'         => $request->input('other1'),
                    
                    'start_date'    => $request->input('start_date1'),
                    
                    'end_date'      => $request->input('end_date1'),
                    
                ];
                if(isset($data['start_date']) && is_array($data['start_date'])){
                        
                    for($i=0;$i<count($data['start_date']);$i++){
                        
                        UserWoringHistoryPublicSetor::create([

                            'using_user_id' =>$data['using_user_id'],
                            
                            'start_date'    =>$data['start_date'][$i],

                            'end_date'      =>$data['end_date'][$i],
                            
                            'ministry'      =>$data['ministry'][$i],
                            
                            'economy'       =>$data['economy'][$i],
                            
                            'position'      =>$data['position'][$i],

                            'other'         =>$data['other'][$i],
                        ]);
                    }
                }

            }
            return $data;
        }
    
        function get_data_working_history_private_sector(Request $request,$id=null){
                
    
            $data = [
                            
                'using_user_id' =>$id,
                
                'tecnology'      => $request->input("tecnology_ps1"),
                
                'economy'       => $request->input("economy_ps1"),

                'position'      => $request->input("position_ps1"),
                
                'other'         => $request->input('other_ps1'),
                
                'start_date'    => $request->input('start_date_ps1'),
                
                'end_date'      => $request->input('end_date_ps1'),
                
            ];
            if(isset($data['start_date']) && is_array($data['start_date'])){
                    
                for($i=0;$i<count($data['start_date']);$i++){
                    
                    UserWoringHistoryPrivateSetor::create([

                        'using_user_id' =>$data['using_user_id'],
                        
                        'start_date'    =>$data['start_date'][$i],

                        'end_date'      =>$data['end_date'][$i],
                        
                        'tecnology'      =>$data['tecnology'][$i],
                        
                        'economy'       =>$data['economy'][$i],
                        
                        'position'      =>$data['position'][$i],

                        'other'         =>$data['other'][$i],
                    ]);
                }
            }
            return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');
        }
    
        public function add_user_working_histories(Request $request) {
                
            $id = intval($request->input("using_user_id"));
        
            if ($this->get_data_working_history_private_sector($request, $id)) {
                
                if ($this->update_data_working_history_public_sector($request) && $this->update_data_working_history_private_sector($request)) {
                
                    if ($this->get_data_working_history_public_sector($request, $id)) {
                
                        return redirect()->back()->with('msg', 'ត្រូវបានរក្សារទុកដោយជោគជ័យ');
                
                    } else {
                
                        return redirect()->back()->with('error', 'Failed to retrieve public sector data after update');
                
                    }
                
                } else {
                
                    return redirect()->back()->with('error', 'Failed to update public or private sector data');
                
                }
            }

        }

        public function user_work_history($id) {
            
            $workingHistoryPublicSector = UserWoringHistoryPublicSetor::where('using_user_id', '=', $id)->get();
        
            $workingHistoryPrivateSector = UserWoringHistoryPrivateSetor::where('using_user_id', '=', $id)->get();
    
            $html = '';
        
            if ($workingHistoryPublicSector->isEmpty() && $workingHistoryPrivateSector->isEmpty()) {
                // Both public and private sectors are empty
                $html = View::make('components.user.working_history', ['id' => $id])->render();
        
            }elseif (!$workingHistoryPublicSector->isEmpty() && !$workingHistoryPrivateSector->isEmpty()) {
                // Both public and private sector histories are not empty
                $html = View::make('components.user.working_history', [
            
                    'id' => $id,
            
                    'workingHistoryPublicSector' => $workingHistoryPublicSector,
            
                    'workingHistoryPrivateSector' => $workingHistoryPrivateSector
            
                    ])->render();
            
            }elseif (!$workingHistoryPublicSector->isEmpty()) {
                // Public sector history is not empty
                $html = View::make('components.user.working_history', ['id' => $id, 'workingHistoryPublicSector' => $workingHistoryPublicSector])->render();
            
            } elseif (!$workingHistoryPrivateSector->isEmpty()) {
                // Private sector history is not empty
                $html = View::make('components.user.working_history', ['id' => $id, 'workingHistoryPrivateSector' => $workingHistoryPrivateSector])->render();
            
            }
        
            // Return the HTML content as JSON
            return response()->json(['html' => $html]);
        }
     // ----------------------------End user_work_history-----------------------------------------

    // ----------------------------------modal_certificate_of_appreciateion------------------------
    
        function get_update_data_modal_certificate_of_appreciateion(Request $request){
            $data = [

                'id'                =>$request->input('id'),

                'economy'           =>$request->input('economy'),

                'type'              =>$request->input('type'),

                'decription'        =>$request->input('decription'),

                'date'              =>$request->input('date'),

                'status'            =>$request->input('status'),
            
                'document'          => $request->hasFile('document') ? $request->file('document') : [],

                'old_document'      =>$request->input('old_document')
        
            ];

            if (isset($data['id']) && is_array($data['id'])) {
            
                foreach ($data['id'] as $index => $certificate) {
            
                    $modalCertificate = UserModalCertificate::find($certificate);
                    
                    if ($modalCertificate) {
            
                        $documentPath = isset($data['document'][$index]) ? $data['document'][$index] : null;
                        
                        // Check if a new file was uploaded
                        if ($documentPath) {
                
                            $destinationPath = 'document_cetificates/';
                
                            $profileImage = uniqid(). "." . $documentPath->getClientOriginalExtension();
                
                            $documentPath->move($destinationPath, $profileImage);
                
                            $documentPath = $profileImage;
            
                        } else {
                            // Use the old document path if available
            
                            $documentPath = isset($data['old_document'][$index]) ? $data['old_document'][$index] : 'default.png';
            
                        }

                        $modalCertificate->update([
                                
                            'economy'       => $data['economy'][$index],
                            
                            'type'          => $data['type'][$index],
                            
                            'decription'    => $data['decription'][$index],

                            'date'          => $data['date'][$index],

                            'status'        =>intval($data['status'][$index]),
                
                            'document'      => $documentPath,
            
                        ]);
                    }
                }
            }
            
            return $data;
        }
        function get_add_data_modal_certificate_of_appreciateion(Request $request){
            
            $request->validate([
                
                'date1.*'          =>'required|date',
                
                'economy1.*'       =>['nullable'],

                'type1.*'          =>['nullable'],
                
                'status1.*'        =>['nullable'],

                'decription1.*'    =>['nullable'],
        
            ]);
                        
            
                $data=[

                    'using_user_id'     =>$request->input('using_user_id'),

                    'economy'           =>$request->input('economy1'),

                    'type'              =>$request->input('type1'),

                    'decription'        =>$request->input('decription1'),

                    'date'            =>$request->input('date1'),

                    'status'            =>$request->input('status1'),

                    // 'document'=>$documentPaths1,

                ];
                // echo "<pre>";
                // var_dump($data);
                // die();

                if(isset($data['date']) && is_array($data['date'])) {
            
                    for ($i = 0; $i < count($data['date']); $i++) {

                        $documentPath = 'default.png'; // Default document path

                        if ($request->hasFile("document1.$i")) {

                            $file = $request->file("document1.$i");

                            $destinationPath = 'document_cetificates/';

                            $profileImage = uniqid() . "." . $file->getClientOriginalExtension();

                            $file->move($destinationPath, $profileImage);

                            $documentPath =  $profileImage;

                        }
                
                            UserModalCertificate::create([

                                'using_user_id'=>$data['using_user_id'],
                                
                                'economy' => $data['economy'][$i],
                                
                                'type' => $data['type'][$i],
                                
                                'decription' => $data['decription'][$i],

                                'date' => $data['date'][$i],

                                'status'=>intval($data['status'][$i]),

                                'document' =>    $documentPath ,

                            ]);
                        }
                }
                return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');
        }
        public function add_modal_certificate_of_appreciateion(Request $request){


            if( $this->get_add_data_modal_certificate_of_appreciateion($request) && $this->get_update_data_modal_certificate_of_appreciateion($request) ){

                    return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');
            
            }
            
            return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');
                
        }
        public function modal_certificate_of_appreciateion($id) {
            
            $modalCertificate=UserModalCertificate::where('using_user_id', '=', $id)->get();
            
            $html ='';
            
            if ($modalCertificate->isEmpty()) {
                // If $user_information is empty, render the view without it
                $html = View::make('components.user.modal_certificate_of_appreciateion', ['id' => $id])->render();
                
            } else {
                // If $user_information is not empty, render the view with all data
                $html = View::make('components.user.modal_certificate_of_appreciateion', [
                
                    'id' => $id,
                
                    'modalCertificate' => $modalCertificate,
            
                ])->render();
    
            }
        
            // Return the HTML content as JSON
            return response()->json(['html' => $html]);
        }
            
    // ----------------------------------End modal_certificate_of_appreciateion-----------------------
    
    // -------------------------------------eduction_level--------------------------------------------
  
        function get_update_data_education_level(Request $request)
        {
            $data = [
                'id'                   => $request->input('id'),
            
                'start_date'           => $request->input('start_date'),
            
                'end_date'             => $request->input('end_date'),
            
                'cetificate'          => $request->input('cetificate'), // corrected 'cetificate' to 'certificate'
            
                'status'               => $request->input('status'),
            
                'level'                => $request->input('level'),
            
                'education_intitution'=> $request->input('education_intitution'), // corrected 'education_intitution' to 'education_institution'
            ];

            if (isset($data['id']) && is_array($data['id'])) {
            
                foreach ($data['id'] as $index => $education_id) {
            
                    $educationLevel = UserEducationLevel::find($education_id);
            
                    if ($educationLevel) {
            
                        $educationLevel->update([
            
                            'start_date'            => $data['start_date'][$index],
            
                            'end_date'              => $data['end_date'][$index],
            
                            'cetificate'           => $data['cetificate'][$index],
            
                            'level'                 => $data['level'][$index],
            
                            'status'                => intval($data['status'][$index]),
            
                            'education_intitution' => $data['education_intitution'][$index],
            
                        ]);
                    }
                }
            }
            return redirect()->back()->with('msg', 'Update successful');
        }
    
        function get_add_data_education_level(Request $request){
            
            $request->validate([
                
                'start_date1.*'             =>'required|date',
                
                'end_date1.*'               =>['nullable'],

                'level1.*'                  =>['nullable'],
                
                'education_intitution1.*'   =>['nullable'],

                'cetificate1.*'             =>['nullable'],

                'status1.*'                 =>['nullable'],

        
            ]);
                        
            
                $data=[

                    'using_user_id'        =>$request->input('using_user_id'),

                    'start_date'           =>$request->input('start_date1'),

                    'end_date'             =>$request->input('end_date1'),

                    'cetificate'           =>$request->input('cetificate1'),

                    'status'               =>$request->input('status1'),

                    'level'               =>$request->input('level1'),

                    'education_intitution' =>$request->input('education_intitution1'),
                

                ];
            

                if(isset($data['start_date']) && is_array($data['start_date'])) {
            
                    for ($i = 0; $i < count($data['start_date']); $i++) {
                
                                UserEducationLevel::create([
        
                                'using_user_id' =>$data['using_user_id'],
                                
                                'start_date'    => $data['start_date'][$i],
                                
                                'end_date'      => $data['end_date'][$i],

                                'cetificate'    => $data['cetificate'][$i],

                                'level'         => $data['level'][$i],
        
                                'status'        =>intval($data['status'][$i]),

                                'education_intitution' => $data['education_intitution'][$i],
                            ]);
                        }
                }
                return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');
        }
    
        public function add_eduction_level(Request $request){

            if( $this->get_add_data_education_level($request)&& $this->get_update_data_education_level($request)){
                    
                return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');

            }

            return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');        
                
        }
    
        public function education_level($id){
            
        
            $eductionLevel=UserEducationLevel::where('using_user_id', '=', $id)->get();
            
            $html ='';
            
            if ($eductionLevel->isEmpty()) {
                // If $user_information is empty, render the view without it
                $html = View::make('components.user.education_level', ['id' => $id])->render();
                
            } else {
                // If $user_information is not empty, render the view with all data
                $html = View::make('components.user.education_level', [
                
                    'id' => $id,
                
                    'eductionLevel' => $eductionLevel,
            
                ])->render();
    
            }
        
            // Return the HTML content as JSON
            return response()->json(['html' => $html]);
        }
             
    // -------------------------------------end_eduction_level--------------------------------------------

    // -------------------------ability_language---------------------------------------------------------

        function get_update_data_ability_language(Request $request){

            $data = [

                'id'               => $request->input('id'),
                
                'language'        =>$request->input('language'),

                'read'            =>$request->input('read'),

                'write'           =>$request->input('write'),

                'speak'           =>$request->input('speak'),

                'listen'          =>$request->input('listen'),// corrected 'education_intitution' to 'education_institution'
            ];
        
            if (isset($data['id']) && is_array($data['id'])) {
            
                foreach ($data['id'] as $index => $langauge_id) {
            
                    $langaugSkill = UserAbilityLanguage::find($langauge_id);
            
                    if ($langaugSkill) {
            
                        $langaugSkill->update([
                        
                            'language' => $data['language'][$index],
                            
                            'read'  => $data['read'][$index],

                            'write'  => $data['write'][$index],

                            'speak'  => $data['speak'][$index],

                            'listen' => $data['listen'][$index],
            
                        ]);
                    }
                }
            }

            return redirect()->back()->with('msg', 'Update successful');
        }
    
        function get_add_ability_language(Request $request){
            
            $request->validate([
                
                'language1.*'   =>'required|string',
                
                'read1.*'       =>['nullable'],

                'write1.*'      =>['nullable'],
                
                'speak1.*'      =>['nullable'],

                'listen1.*'     =>['nullable'],
        
            ]);
                        
            
            $data=[

                'using_user_id'   =>$request->input('using_user_id'),

                'language'        =>$request->input('language1'),

                'read'            =>$request->input('read1'),

                'write'           =>$request->input('write1'),

                'speak'           =>$request->input('speak1'),

                'listen'          =>$request->input('listen1'),

            ];
            if(isset($data['language']) && is_array($data['language'])) {
            
                for ($i = 0; $i < count($data['language']); $i++) {
            
                        UserAbilityLanguage::create([

                            'using_user_id' =>$data['using_user_id'],
                            
                            'language' => $data['language'][$i],
                            
                            'read'  => $data['read'][$i],

                            'write'  => $data['write'][$i],

                            'speak'  => $data['speak'][$i],

                            'listen' => $data['listen'][$i],
                        ]);
                    }
            }

            return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');

        }
    
        public function add_ability_language(Request $request){

            if($this->get_add_ability_language($request)&& $this->get_update_data_ability_language($request)){
                
                return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ'); 

            }
    
            return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');   

        }
    
        public function ability_language($id){

            $langaugeSkill=UserAbilityLanguage::where('using_user_id', '=', $id)->get();
            
            $html ='';
            
            if ($langaugeSkill->isEmpty()) {
                // If $user_information is empty, render the view without it
                $html = View::make('components.user.ability_language', ['id' => $id])->render();
                
            } else {
                // If $user_information is not empty, render the view with all data
                $html = View::make('components.user.ability_language', [
                
                    'id' => $id,
                
                    'langaugeSkill' => $langaugeSkill,
            
                ])->render();
    
            }
        
            // Return the HTML content as JSON
            return response()->json(['html' => $html]);
        }
    // -------------------------end ability_language---------------------------------------------------
    
     function update_user_family(Request $request,$id){
     
        $data=[

            'father_name'=>$request->input('father_name'),
            
            'father_name_in_english'=>$request->input('father_name_eng'),
            
            'father_status'=>$request->input('father_status'),
            
            'father_date'=>$request->input('f_date_first_birst'),
            
            'father_national'=>$request->input('f_national'),
            
            'father_job'=>$request->input('f_job'),
            
            'f_institute'=>$request->input('f_institudeOr_unit'),
            
            'f_current_residence'=>$request->input('f_current_residence'),
            
            'mother_name'=>$request->input('m_name'),
            
            'mother_name_in_english'=>$request->input('m_name_eng'),
            
            'mother_status'=>$request->input('m_status'),
            
            'mother_date'=>$request->input('m_date_of_birst'),
            
            'mother_national'=>$request->input('m_national'),
            
            'm_current_residence'=>$request->input('m_current_residence'),
            
            'mother_job'=>$request->input('m_job'),
            
            'm_institute'=>$request->input('m_instituteOr_unit'),
            
            'federation_name'=>$request->input('federation_name'),
            
            'federation_name_in_english'=>$request->input('eng_federation_name'),
            
            'federation_status'=>$request->input('federation_status'),
            
            'federation_date'=>$request->input('date_federation'),
            
            'federation_national'=>$request->input('federation_national'),
            
            'federation_current_residence'=>$request->input('federation_current_residence'),
            
            'federation_job'=>$request->input('federation_job'),
            
            'federation_institute'=>$request->input('federation_institute'),
            
            'federation_allowance'=>$request->input('federation_allowance'),
            
            'federation_phone_number'=>$request->input('federation_phone_number'),

            'children_name' =>  serialize($request->input('c_name')),

            'children_name_in_english' =>  serialize($request->input('c_eng_name')),

            'children_gender' =>  serialize($request->input('c_gender')),

            'children_date' =>  serialize($request->input('c_date')),

            'children_job' =>  serialize($request->input('c_job')),
            
            'children_allowance' =>  serialize($request->input('c_allowance')),

            
            'relative_name' =>  serialize($request->input('name_relative')),

            'relative_name_in_english' =>  serialize($request->input('eng_name_relative')),

            'relative_gender' =>  serialize($request->input('relative_gender')),

            'relative_date' =>  serialize($request->input('relative_date_of_birth')),

            'relative_job' =>  serialize($request->input('relative_job')),
            

        ];
        
      
        UserFamily::where('using_user_id',$id)->update($data);
       
       
    }
    public function add_user_family(Request $request){
     
        $data=[

            'using_user_id'=>$request->input('using_user_id'),

            'father_name'=>$request->input('father_name'),
            
            'father_name_in_english'=>$request->input('father_name_eng'),
            
            'father_status'=>$request->input('father_status'),
            
            'father_date'=>$request->input('f_date_first_birst'),
            
            'father_national'=>$request->input('f_national'),
            
            'father_job'=>$request->input('f_job'),
            
            'f_institute'=>$request->input('f_institudeOr_unit'),
            
            'f_current_residence'=>$request->input('f_current_residence'),
            
            'mother_name'=>$request->input('m_name'),
            
            'mother_name_in_english'=>$request->input('m_name_eng'),
            
            'mother_status'=>$request->input('m_status'),
            
            'mother_date'=>$request->input('m_date_of_birst'),
            
            'mother_national'=>$request->input('m_national'),
            
            'm_current_residence'=>$request->input('m_current_residence'),
            
            'mother_job'=>$request->input('m_job'),
            
            'm_institute'=>$request->input('m_instituteOr_unit'),
            
            'federation_name'=>$request->input('federation_name'),
            
            'federation_name_in_english'=>$request->input('eng_federation_name'),
            
            'federation_status'=>$request->input('federation_status'),
            
            'federation_date'=>$request->input('date_federation'),
            
            'federation_national'=>$request->input('federation_national'),
            
            'federation_current_residence'=>$request->input('federation_current_residence'),
            
            'federation_job'=>$request->input('federation_job'),
            
            'federation_institute'=>$request->input('federation_institute'),
            
            'federation_allowance'=>$request->input('federation_allowance'),
            
            'federation_phone_number'=>$request->input('federation_phone_number'),

            'children_name' =>  serialize($request->input('c_name')),

            'children_name_in_english' =>  serialize($request->input('c_eng_name')),

            'children_gender' =>  serialize($request->input('c_gender')),

            'children_date' =>  serialize($request->input('c_date')),

            'children_job' =>  serialize($request->input('c_job')),

            'children_allowance' =>  serialize($request->input('c_allowance')),
            
            'relative_name' =>  serialize($request->input('name_relative')),

            'relative_name_in_english' =>  serialize($request->input('eng_name_relative')),

            'relative_gender' =>  serialize($request->input('relative_gender')),

            'relative_date' =>  serialize($request->input('relative_date_of_birth')),

            'relative_job' =>  serialize($request->input('relative_job')),
            

        ];

        $id=$request->input('using_user_id');
        $user_id=UserFamily::where('using_user_id',$id)->select('using_user_id')->first();

       if(!$user_id==$id ||$user_id==null){
        UserFamily::create($data);
       }else{
        $this->update_user_family($request,$id);
       }
       return redirect()->back()->with('msg','ត្រូវបានរក្សារទុកដោយជោគជ័យ');   
        
        
       
      
     
    }
    public function user_family($id){

        $userFamily=UserFamily::where('using_user_id', '=', $id)->first();
        
        $html ='';
        
        if ($userFamily==null) {
            // If $user_information is empty, render the view without it
            $html = View::make('components.user.user_family', ['id' => $id])->render();
            
        } else {
            // If $user_information is not empty, render the view with all data
            $html = View::make('components.user.user_family', [
            
                'id' => $id,
            
                'userFamily' => $userFamily,
        
            ])->render();

        }
    
        // Return the HTML content as JSON
        return response()->json(['html' => $html]);
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
   
}
