<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserUpdateInforRequest;
use App\Models\AdditionalPositionCurrentJob;
use App\Models\Department;
use App\Models\Office;
use App\Models\Role;
use App\Models\User;
use App\Models\User_Infromation;
use App\Models\UserAbilityLanguage;
use App\Models\UserEducationLevel;
use App\Models\UserFamily;
use App\Models\UserModalCertificate;
use App\Models\UserWoringHistoryPrivateSetor;
use App\Models\UserWoringHistoryPublicSetor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserProfileController extends Controller
{
     function index() : View {

        $id=session('user_id');

        $user = User::find($id);

        $additionalPCJ = AdditionalPositionCurrentJob::where('using_user_id', '=', $id)->get();

        $userWoringHistoryPublicSetor = UserWoringHistoryPublicSetor::where('using_user_id', '=', $id)->get();

        $userWoringHistoryPrivateSetor = UserWoringHistoryPrivateSetor::where('using_user_id', '=', $id)->get();

        $roles = Role::select()->orderBy('id', 'desc')->get();

        $departments = Department::all();
        
        $offices = Office::all();

        // $userWoringHistoryPrivateSetor = UserWoringHistoryPrivateSetor::where('using_user_id', '=', $id)->get();

        $userModalCertificate = UserModalCertificate::where('using_user_id', '=', $id)->get();

        $userEducationLevel = UserEducationLevel::where('using_user_id', '=', $id)->get();

        $userAbilityLanguage = UserAbilityLanguage::where('using_user_id', '=', $id)->get();

        $user_information = User_Infromation::where('using_user_id', '=', $id)->get()->first();

        $userFamily = UserFamily::where('using_user_id', '=', $id)->get()->first();
    
        
        return view('frontend.company-dashboard.profile.index', compact('user',
        'additionalPCJ',
        'userWoringHistoryPublicSetor',
        'userWoringHistoryPrivateSetor',
        'roles',
        'departments',
        'offices',
        'userModalCertificate',
        'userEducationLevel',
        'userAbilityLanguage',
        'user_information',
        'userFamily'

    ));
    }
   
   
    public function updateUserInfo(Request $request, $id) {
        // Retrieve the user by ID
        $validatedData = $request->validate([
            'firstNameKh' => ['required', 'string'],
            'lastNameKh' => ['required', 'string'],
            'idCard' => ['required', 'string'], // Assuming idCard is a string
            'referent' => ['required', 'string'], // Assuming referent is a string
            'codeEconomy' => ['required', 'string'], // Assuming codeEconomy is a string
            'engName' => ['required', 'string'], // Assuming engName is a string
        ]);
        dd($validatedData);
        
        // $user = User::findOrFail($id);
        
        // // Update user information
        // $user->firstNameKh = $request->firstNameKh;
        // $user->lastNameKh = $request->lastNameKh;
        // $user->idCard = $request->idCard;
        // $user->referent = $request->referent;
        // $user->codeEconomy = $request->codeEconomy;
        // $user->engName = $request->engName;
    
        // // Save the updated user
        // $user->save();
    
        // // Redirect back or to appropriate route
        // return redirect()->back();
    }
   
}
