<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Repositories\Admin\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if(\request()->ajax()) {
            return $this->user->userDataTable($request);
        }
        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $this->user->store($request);
        return redirect()->back()->with('success', 'success');
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password'=>'required|string|min:6|confirmed'
        ]);
        $this->user->resetPassword($request);
        return redirect()->back()->with('success', 'success');
    }
}
