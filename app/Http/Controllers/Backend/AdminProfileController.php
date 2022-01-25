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
        $profile = Admin::find(1);
        return view('admin.admin_profile', compact('profile'));
    }


    public function adminProfileEdit()
    {
        $editProfile = Admin::find(1);
        return view('admin.admin_profile_edit', compact('editProfile'));
    }

    public function adminProfileStore(Request $request)
    {
        $data = Admin::find(1);
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

       $hashedPassword = Admin::find(1)->password;
       if (Hash::check($request->current_password,$hashedPassword)) {
           $admin = Admin::find(1);
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
               'alert-type' => 'error'
           );
           return redirect()->back()->with($notifications);
       }

    }
}
