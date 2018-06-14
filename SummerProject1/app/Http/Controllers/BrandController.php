<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\brand;

class BrandController extends Controller
{
    public function getList(){
      $brand = brand::all();
      return view('admin.brand.list',['brand'=>$brand]);
    }

    public function getAdd(){
      return view('admin.brand.add');
    }
    public function postAdd(Request $request){
      $this->validate($request,
      [
        'name' => 'required|unique:brand,name'
      ],
      [
        'name.required' => 'Vui lòng nhập tên hãng',
        'name.unique' => 'Tên hãng đã tồn tại'
      ]);
      $brand = new brand;
      $brand->name = $request->name;

      $brand->save();
      return redirect('admin/brand/add')->with('notify', 'Thêm thành công!');
    }

    public function getEdit($id){
      $brand = brand::find($id);
      return view('admin.brand.edit',['brand'=>$brand]);
    }
    public function postEdit(Request $request, $id){
      $brand = brand::find($id);
      $this->validate($request,
      [
        'name' => 'required|unique:brand,name'
      ],
      [
        'name.required' => 'Vui lòng nhập tên hãng',
        'name.unique' => 'Tên hãng đã tồn tại'
      ]);
      $brand->name = $request->name;

      $brand->save();
      return redirect('admin/brand/edit/'.$id)->with('notify','Sửa thành công!');
    }

    public function getDelete($id){
      $brand = brand::find($id);
      // $brand->delete();
      $brand->status = 0;
      $brand->save();
      return redirect('admin/brand/list')->with('notify', 'Xóa thành công!');
    }
}
