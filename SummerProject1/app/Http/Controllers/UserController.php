<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  public function getList(){
    $user = User::all();
    return view('admin.user.list',['user'=>$user]);
  }

  public function getAdd(){
    return view('admin.user.add');
  }

  public function postAdd(Request $request){
    $this->validate($request,
    [
      'name' => 'required',
      'displayname' => 'required',
      'email' =>'required|email|unique:users,email',
      'password' => 'required|min:6|max:32',
      'passwordAgain' => 'required|same:password',
      'phone_number' => 'required|min:10|max:11',
      'address' => 'required',
      'image' => 'required'
    ],
    [
      'name.required' => 'Vui lòng nhập tên',
      'displayname.required' => 'Vui lòng nhập tên hiển thị trong web',
      'email.required' => 'Vui lòng nhập email',
      'email.email' => 'Định dạng email không hợp lệ',
      'email.unique' => 'Email này đã được sử dụng',
      'password.required' => 'Vui lòng nhập password',
      'password.min' => 'Password phải có từ 6 đến 32 kí tự',
      'password.max' => 'Password phải có từ 6 đến 32 kí tự',
      'passwordAgain.required' => 'Vui lòng nhập password một lần nữa',
      'passwordAgain.same' => 'Field mật khẩu này không khớp với field mật khẩu trước',
      'phone_number.required' =>'Vui lòng nhập sđt của bạn',
      'phone_number.min' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
      'phone_number.max' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
      'address.required' => 'Vui lòng nhập địa chỉ nơi ở hiện tại của bạn',
      'image.required' => 'Vui lòng chọn hình ảnh đại diện',
    ]
  );
  $User = new User;
  $User->name = $request->name;
  $User->displayname = $request->displayname;
  $User->email = $request->email;
  $User->password = bcrypt($request->password);
  $User->phone_number = $request->phone_number;
  $User->address = $request->address;
  $file = $request->file('image');
  // dd($image);
  $image = $file->getClientOriginalName();
    $path= public_path('upload/users/');
    while (file_exists($path.$image)) {
      $image = 'img_'.time().'_'.$file->getClientOriginalName();
    }
    $file->move($path,$image);
    $User->image = $image;

  $User->save();
  return redirect('admin/user/add')->with('notify', 'Đăng ký thành công!');
  }

  public function getEdit($id){
    $user = User::find($id);
    return view('admin.user.edit',['user'=>$user]);
  }

  public function postEdit(Request $request, $id){
    $user = User::find($id);
    $this->validate($request,
    [
      'phone_number' => 'min:10|max:11',
    ],
    [
      'phone_number.min' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
      'phone_number.max' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
    ]);
    $user->name = $request->name;
    $user->displayname = $request->displayname;
    $user->phone_number = $request->phone_number;
    $user->address = $request->address;
    if ($request->changePassword == "on") {
    $this->validate($request,
    [
      'password' => 'required|min:6|max:32',
      'passwordAgain' => 'required|same:password',
    ],
    [
      'password.required' => 'Vui lòng nhập password',
      'password.min' => 'Password phải có từ 6 đến 32 kí tự',
      'password.max' => 'Password phải có từ 6 đến 32 kí tự',
      'passwordAgain.required' => 'Vui lòng nhập password một lần nữa',
      'passwordAgain.same' => 'Field mật khẩu này không khớp với field mật khẩu trước',
    ]);
        $user->password = bcrypt($request->password);
  }
  $user->save();
  return redirect('admin/user/edit/'.$id)->with('notify', 'Sửa thành công');
  }

  public function getDelete($id){
    $user = User::find($id);
    $user->delete();
    return redirect('admin/user/list')->with('notify', 'Xóa thành công');
  }
}
