<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //This function is for retrieve user data from db and view it a blade page
    public function UserView()
    {
        $data['userAllData'] = User::where('usertype', 'Admin')->get();
        return view('backend.user.view_user', $data);
    }

    //This function is for new window form  adding new user 
    public function UserAdd()
    {
        return view('backend.user.add_user');
    }

    //Add user by Admin who can logged in
    public function UserStore(Request $request)
    {
     
        //validate input data
        $validateData = $request->validate([
            'email' => 'required | unique:users',
            'name' => 'required',
        ]);

        //create instance of user and save data to db
        $userData = new User();
        $code = rand(0000,9999);
        $userData->usertype = 'Admin';
        $userData->role = $request->role;
        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->password = bcrypt($code);
        $userData->code = $code;
        $userData->save();

        $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.view')->with($notification);

    }

    //return view edit page for updating user data
    public function EditUser($id)
    {
        $editUserData = User::find($id);
        return view('backend.user.edit_user', compact('editUserData'));
    }

    //update user
    public function UpdateUser(Request $request, $id)
    {
        //create instance of user and save data to db
        $updateUserData =User::find($id);
        $updateUserData->name = $request->name;
        $updateUserData->email = $request->email;
        $userData->role = $request->role;
        $updateUserData->save();

        //set toastr message after finishing successful action
        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.view')->with($notification);
    }

    //Delete users
    public function DeleteUser($id)
    {
        $deleteUser = User::find($id);
        $deleteUser->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->route('user.view')->with($notification);
    }
}
