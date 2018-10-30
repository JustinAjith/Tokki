<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Admin;
use App\SiteVariable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditAppController extends Controller
{
    public function resetPassword()
    {
        return view('admin.setting.edit_app.change_password');
    }

    public function siteVariable()
    {
        $siteVariables = SiteVariable::all();
        return view('admin.setting.edit_app.site_variable', compact('siteVariables'));
    }

    public function resetPasswordSubmit(Request $request)
    {
        $this->validate($request, [
            'current_password'=>'required|string|min:6',
            'password'=>'required|string|min:6|confirmed',
            'password_confirmation'=>'required|string|min:6'
        ]);
        if(!(Hash::check($request->current_password, Auth::user()->password))) {
            $response = 'Your current password does not matches with the password you provided.';
        }
        elseif(strcmp($request->current_password, $request->password)==0) {
            $response = 'New Password cannot be same as your current password. Please choose a different password.';
        }
        else {
            $user = Admin::find(Auth::user()->id);
            $user->update(['password'=>Hash::make($request->password)]);
            return redirect()->back()->with('success', 'success');
        }
        return redirect()->back()->with('error', $response);
    }
}
