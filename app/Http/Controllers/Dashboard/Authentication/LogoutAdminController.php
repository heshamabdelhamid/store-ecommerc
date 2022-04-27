<?php

namespace App\Http\Controllers\Dashboard\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutAdminController extends Controller
{

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}