<?php

namespace App\Http\Controllers;
use File;
use Illuminate\Http\Request;
use App\type_product;

class TypeController extends Controller
{
    public function getList(){
      $type_product = type_product::all();
      return view('admin.type_product.list',['type_product'=>$type_product]);
    }

    public function getAdd(){
      return view('admin.type_product.add');
    }

    public function postAdd(Request $request){
      $this->validate($request,
      [
        'name' => 'required|unique:type_product,name',
        'image' => 'required|mimes:jpg,jpeg,png'
      ],
      [
        'name.required' => 'Vui lòng nhập tên loại sản phẩm',
        'name.unique' => 'Tên loại sản phẩm này đã tồn tại',
        'image.required' => 'Vui lòng chọn hình ảnh cho sản phẩm',
        'image.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg hoặc png'
      ]
    );
    $type_product = new type_product;
    $type_product->name = $request->name;
    $file = $request->file('image');
    // $image_format = $file->getClientOriginalExtension();
    // if ($image_format!='jpg' && $image_format!='png' && $image_format!='jpeg'&& $image_format!='JPG' && $image_format!='PNG' && $image_format!='JPEG') {
    //    return redirect('admin/type_product/add')->with('notify','Bạn chỉ được phép up ảnh có định dạng jpg,jpeg và png!');
    //   }
      $image = $file->getClientOriginalName();
      $path= public_path('upload/product/');
      while (file_exists($path.$image)) {
        $image = 'img_'.time().'_'.$file->getClientOriginalName();
      }
      $file->move($path,$image);
      $type_product->image = $image;

      $type_product->save();
      return redirect('admin/type_product/add')->with('notify','Thêm thành công!');
    }

    public function getEdit($id){
      $type_product = type_product::find($id);
      return view('admin.type_product.edit',['type_product'=>$type_product]);
    }
    public function postEdit(Request $request, $id){
      $type_product = type_product::find($id);
      $this->validate($request,
      [
        'name' => 'required',
        'image' =>'mimes:jpg,jpeg,png'
      ],
      [
        'name.required' => 'Vui lòng nhập tên loại sản phẩm',
        'image.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg hoặc png'
      ]);
      $type_product->name = $request->name;
      if ($request->hasFile('image')) {
        $path= public_path('upload/product/');
        $old_image =  $type_product->image;
        File::delete($path.$old_image);

        // $image_format = $file->getClientOriginalExtension();
        // if ($image_format!='jpg' && $image_format!='png' && $image_format!='jpeg'&& $image_format!='JPG' && $image_format!='PNG' && $image_format!='JPEG') {
        //    return redirect('admin/type_product/add')->with('notify','Bạn chỉ được phép up ảnh có định dạng jpg,jpeg và png!');
        //   }
          $file = $request->file('image');
          $image = $file->getClientOriginalName();
          while (file_exists($path.$image)) {
            $image = 'img_'.time().'_'.$file->getClientOriginalName();
          }
          $file->move($path,$image);
          $type_product->image = $image;
      }

      $type_product->save();
      return redirect('admin/type_product/edit/'.$id)->with('notify','Sửa thành công!');
    }

    public function getDelete($id){
      $type_product = type_product::find($id);
      // $image = $type_product->image;
      // $path= public_path('upload/product/');
      // File::delete($path.$image);
      // $type_product->delete();
      $type_product->status = 0;
      $type_product->save();

      return redirect('admin/type_product/list')->with('notify', 'Xóa thành công!');
    }
}
