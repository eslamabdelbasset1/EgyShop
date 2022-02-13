<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        $id = Auth::user()->id;
        $adminData = Admin::find($id);
        return view('admin.admin_profile', compact('adminData'));
    }


    public function adminProfileEdit()
    {
        $id = Auth::user()->id;
        $editData = Admin::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->name = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin/profile/'.$data->profile_photo_path));
            $fileName =  Carbon::now()->format('Y-m-d-H-i').$file->getClientOriginalName();
            $file->move(public_path('upload/admin/profile'),$fileName);
            $data['profile_photo_path'] = $fileName;
        }
        $data->save();

        $notifications = array(
            'message' => 'Admin profile is updated',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notifications);
    }

    public function adminChangePassword()
    {
        return view('admin.adminChangePassword');
    }

    public function adminUpdatePassword(Request $request)
    {
       $validatePassword = $request->validate([
           'current_password' => 'required',
           'password' => 'required|confirmed'
       ]);

        $hashedPassword = Auth::user()->password;
       if (Hash::check($request->current_password,$hashedPassword)) {
           $admin = Admin::find(Auth::id());
           $admin->password = Hash::make($request->password);
//           dd($admin);
           $admin->save();
           Auth::logout();

           $notifications = array(
               'message' => 'New Password is updated',
               'alert-type' => 'success'
           );
           return redirect()->route('admin.logout')->with($notifications);
       }else
       {
           $notifications = array(
               'message' => 'Password is incorrect',
               'alert-type' => 'errors'
           );
           return redirect()->back()->with($notifications);
       }

    }

    public function allUsers(){
        $users = User::latest()->get();
        return view('backend.user.all_user',compact('users'));
    }
}
