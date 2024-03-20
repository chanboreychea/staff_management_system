<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserUpdateInforRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserProfileController extends Controller
{
     function index() : View {

        $cardId=session('user_id');
        
        $userInformation = User::where('idCard',$cardId)->get()->first();
        
        return view('frontend.company-dashboard.profile.index', compact('userInformation'));
    }

    // function updateUserInfo(UserUpdateInforRequest $request,$id):RedirectResponse{

    //     // if ($request->hasfile('img')) {
    //     //     $file = $request->file('img');
    //     //     $extenstion = $file->getClientOriginalExtension();
    //     //     $filename = Str::random(30) . '.' . strval($extenstion);
    //     //     $file->move('images/', $filename);
    //     // }
    //     // $user = new User();

    //     // $user->firstNameKh = 
    //     echo $id;

    //     echo $request->firstNameKh;
        
    //     // $user->lastNameKh = 
    //     echo $request->lastNameKh;
        
    //     // $user->idCard = 
    //     echo $request->idCard;
        
    //     // $user->referent =
    //     echo $request->referent;
        
    //     // $user->codeEconomy =
    //     echo  $request->codeEconomy;
        
    //     // $user->engName=
    //     echo $request->engName;

    //     die();
        
    //     // $user->gender = $request->input('gender');
    //     // $user->email = $request->input('email');
    //     // $user->password = Hash::make($request->input('password'), ['rounds' => 12]);
    //     // $user->phoneNumber = $request->input('phoneNumber');
        
    //     // $user->dateOfBirth = $request->input('dateOfBirth');
    //     // $user->status = $request->input('status');
    //     // $user->nationality = $request->input('nationality');
    //     // $user->pobAddress = $request->input('pobAddress');
    //     // $user->currentAddress = $request->input('currentAddress');
     
    //     // $user->passport = $request->input('passport');
    //     // $user->identifyCard = $request->input('identifyCard');
    //     // $user->exprireDateIdenCard = $request->input('exprireDateIdenCard');
    //     // $user->exprirePassport = $request->input('exprirePassport');
      
    //     // $user->save();
    //     // return redirect()->back();
    // }
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
