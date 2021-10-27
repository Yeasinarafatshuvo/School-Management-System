<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    //return web page with login user data
    public function ProfileView()
    {
        $loginUserId = Auth::user()->id;
        $loginUserIdData = User::find($loginUserId);
        return view('backend.user.view_profile', compact('loginUserIdData'));
    }

    //return profile edited page with authenticate user  data
    public function ProfileEdit()
    {
        $loginUserId = Auth::user()->id;
        $editUserData = User::find($loginUserId);
        return view('backend.user.edit_profile', compact('editUserData'));
    }

    //this function update profile data 
    public function ProfileStore(Request $request)
    {
       
        $findUserData = User::find(Auth::user()->id);
        $findUserData->name = $request->name;
        $findUserData->email  = $request->email;
        $findUserData->mobile = $request->mobile;
        $findUserData->address = $request->address;
        $findUserData->gender = $request->gender;

        if($request->file('image'))
        {
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $fileName = date('YmHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'), $fileName);
            $findUserData['image'] = $fileName;
        }
        $findUserData->save();

        $notification = array(
            'message' => 'User Profile update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('profile.view')->with($notification);
    }

    public function PasswordView()
    {
        return view('backend.user.edit_password');
    }

    public function PasswordUpdate(Request $request)
    {
       
        //validate input data
        $validateData = $request->validate([
            'old_password' => 'required',
            'password' => 'required |confirmed',
        ]);


        $hashPassword = Auth::user()->password;
        if(Hash::check($request->old_password,$hashPassword ))
        {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');

        }
        else
        {
            return redirect()->back();
        }
    }

}
