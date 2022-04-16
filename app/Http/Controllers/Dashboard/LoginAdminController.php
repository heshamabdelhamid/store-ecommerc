<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginAdminRequest;
use Illuminate\Http\Request;

class LoginAdminController extends Controller
{
    public function getlogin()
    {
        return view('dashboard.auth.login');
    }

    public function postLogin(LoginAdminRequest $request)
    {
        //validation in LoginAdminRequest
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember_me)) {

            return redirect()->route('admin.index');
        }


        return redirect()->back()->with(['error' => 'هناك خطأ بابيانات ']);
    }
}
