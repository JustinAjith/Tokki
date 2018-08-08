<?php
namespace App\Repositories\User;

use App\Http\Requests\User\Setting\PasswordRequest;
use App\Http\Requests\User\Setting\ProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class SettingRepository
{
    protected $user;
    public function __construct(User $user = null)
    {
        $this->user = $user ?? new User;
    }

    public function getUser($id)
    {
        return $this->user->find($id);
    }

    public function editProfile(ProfileRequest $request)
    {
        $user = $this->getUser(Auth::user()->id);
        $user->update($request->toArray());
        return ['success'=>true];
    }

    public function uploadLogo(Request $request)
    {
        $image = $request->file('profile');
        $ext = $image->getClientOriginalExtension();
        $img = Image::make($image)->resize(400, 400, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        $img->resizeCanvas(400, 400, 'center', false, array(255, 255, 255, 0));
        $rend = rand(00000, 99999).'-'.Auth::user()->id;
        $logoName = $rend.'.'.$ext;
        $img->save(public_path('storage/user_profile/'.$logoName));
        $user = $this->getUser(Auth::user()->id);
        $user->update(['profile'=>$logoName]);
        return ['success'=>true];
    }

    public function editAboutUs(Request $request)
    {
        $user = $this->getUser(Auth::user()->id);
        $user->update(['about_us'=>$request->about_us]);
        return ['success'=>true];
    }

    public function passwordReset(PasswordRequest $request)
    {
        $user = $this->getUser(Auth::user()->id);
        $user->update(['password'=>Hash::make($request->password)]);
        return ['success'=>true];
    }
}