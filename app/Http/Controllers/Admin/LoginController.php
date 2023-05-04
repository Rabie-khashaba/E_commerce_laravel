<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function adminLogin(){
        return view('admin.auth.login');
    }

    public function checkAdminLogin(LoginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('admin.dashboard'); // Admin page
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);

  }


  // way to create new admin in database by tinker


//        $admin = new App\Models\Admin();
//        $admin -> name = 'Ali';
//        $admin -> email = 'Ali@gmail.com';
//        $admin -> password = bcrypt('22222222');
//        $admin -> save();






}

