<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;


class AdminConTroller extends Controller
{
    public function getAdminLogin(){
      return view('admin.layout.login');
    }

    public function postAdminLogin(Request $request){
      $this->validate($request,
      [
        'email' => 'required|email',
        'password' => 'required|min:6|max:32'
      ],
      [
        'email.required' => 'Vui lòng nhập username',
        'email.email' => 'Định dạng email không đúng',
        'password.required' => 'Vui lòng nhập password',
        'password.min' => 'Password không đúng',
        'password.max' => 'Password không đúng'
      ]);
      if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {
        // dd(Auth::guard('admin'));
        return redirect('admin/dashboard');
      }else {
        return redirect('admin/login')->with('notify', 'Đăng nhập không thành công!');
      }
    }

    public function getAdminLogout(){
      Auth::guard('admin')->logout();
      return redirect('admin/login');
    }
}
