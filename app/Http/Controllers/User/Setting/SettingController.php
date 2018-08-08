<?php

namespace App\Http\Controllers\User\Setting;

use App\Http\Requests\User\Setting\PasswordRequest;
use App\Http\Requests\User\Setting\ProfileRequest;
use App\Repositories\User\SettingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SettingController extends Controller
{
    protected $setting;
    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    public function editProfile(): View
    {
        return view('user.settings.edit_profile');
    }

    public function editProfileSubmit(ProfileRequest $request): RedirectResponse
    {
        $this->setting->editProfile($request);
        return redirect()->back()->with('success', 'success');
    }

    public function uploadLogo(): View
    {
        return view('user.settings.upload_logo');
    }

    public function uploadLogoSubmit(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'profile'=>'required'
        ]);
        $this->setting->uploadLogo($request);
        return redirect()->back()->with('success', 'success');
    }

    public function editAboutUs(): View
    {
        return view('user.settings.edit_about_us');
    }

    public function editAboutUsSubmit(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'about_us' => 'required|string|min: 150'
        ]);
        $this->setting->editAboutUs($request);
        return redirect()->back()->with('success', 'success');
    }

    public function changePassword(): View
    {
        return view('user.settings.change_password');
    }

    public function changePasswordSubmit(PasswordRequest $request): RedirectResponse
    {
        if(!(Hash::check($request->current_password, Auth::user()->password))) {
            $response = 'Your current password does not matches with the password you provided.';
        }
        elseif(strcmp($request->current_password, $request->password)==0) {
            $response = 'New Password cannot be same as your current password. Please choose a different password.';
        }
        else {
            $this->setting->passwordReset($request);
            return redirect()->back()->with('success', 'success');
        }
        return redirect()->back()->with('error', $response);
    }
}
