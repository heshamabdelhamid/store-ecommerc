<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminProfile extends Controller
{

    public function getAdminProfile()
    {
        $admin = Admin::FindOrFail(auth('admin')->user()->id);
        return view('dashboard.profile.edit', compact('admin'));
    }


    public function updateAdminProfile(UpdateAdminProfileRequest $request)
    {

        try {

            $admin = Admin::find(auth('admin')->user()->id);


            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
            }
            unset($request['password_confirmation']);

            $admin->update($request->all());

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
        }
    }
}
