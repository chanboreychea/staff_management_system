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
}
