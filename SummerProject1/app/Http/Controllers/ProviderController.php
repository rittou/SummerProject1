<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\provider;


class ProviderController extends Controller
{
    public function getList(){
      $provider = provider::all();
      return view('admin.provider.list',['provider'=>$provider]);
    }

    public function getAdd(){
      return view('admin.provider.add');
    }

    public function postAdd(Request $request){
      $this->validate($request,
      [
        'name' => 'required|unique:provider,name',
        'address' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required'
      ],
      [
        'name.required' => 'Vui lòng nhập tên nhà cung cấp',
        'name.unique' => 'Tên nhà cung cấp này đã tồn tại',
        'address.required' => 'Vui lòng nhập địa chỉ nhà cung cấp',
        'email.required' => ' Vui lòng nhập email của nhà cung cấp',
        'email.email' => 'Định dạng email không đúng',
        'phone_number.required' => 'Vui lòng nhập số điện thoại của nhà cung cấp'
      ]);
      $provider = new provider;
      $provider->name = $request->name;
      $provider->address = $request->address;
      $provider->email = $request->email;
      $provider->phone_number = $request->phone_number;

      $provider->save();
      return redirect('admin/provider/add')->with('notify', 'Thêm thành công');
    }

    public function getEdit($id){
      $provider = provider::find($id);
      return view('admin.provider.edit',['provider'=>$provider]);
    }

    public function postEdit(Request $request, $id){
      $this->validate($request,
      [
        'name' => 'required',
        'address' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required'
      ],
      [
        'name.required' => 'Vui lòng nhập tên nhà cung cấp',
        'name.unique' => 'Tên nhà cung cấp này đã tồn tại',
        'address.required' => 'Vui lòng nhập địa chỉ nhà cung cấp',
        'email.required' => ' Vui lòng nhập email của nhà cung cấp',
        'email.email' => 'Định dạng email không đúng',
        'phone_number.required' => 'Vui lòng nhập số điện thoại của nhà cung cấp'
      ]);
      $provider = provider::find($id);
      $provider->name = $request->name;
      $provider->address = $request->address;
      $provider->email = $request->email;
      $provider->phone_number = $request->phone_number;

      $provider->save();
      return redirect('admin/provider/edit/'.$id)->with('notify', 'Sửa thành công');
    }

    public function getDelete($id){
      $provider = provider::find($id);
      // $provider->delete();
      $provider->status = 0;
      $provider->save();
      return redirect('admin/provider/list')->with('notify', 'Xoá thành công');
    }
}
