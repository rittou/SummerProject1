<?php

namespace App\Http\Controllers;
use File;
use Illuminate\Http\Request;
use App\type_product;
use App\product;
use App\product_images;
use App\brand;
use App\provider;

class ProductController extends Controller
{
    public function getList(){
      $product = product::all();
      return view('admin.product.list',['product'=>$product]);
    }

    public function getAdd(){
      $type_product = type_product::all();
      $brand = brand::all();
      $provider = provider::all();
      return view('admin.product.add',['type_product'=>$type_product,'brand'=>$brand,'provider'=>$provider]);
    }
    public function postAdd(Request $request){
      $this->validate($request,[
        'name' => 'required|unique:product,name',
        'image' => 'required',
        'image.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        'id_type' => 'required',
        'id_brand' => 'required',
        'id_provider' => 'required',
        'description' => 'required',
        'regular_price' => 'required|numeric',
        'sale_price' => 'numeric|nullable',
      ],
      [
        'name.required' => 'Vui lòng nhập tên sản phẩm',
        'name.unique' => 'Tên sản phẩm này đã bị trùng',
        'image.required' => 'Vui lòng chọn hình cho sản phẩm',
        'image.image' => '1',
        'image.mimes' => '2',
        'image.max' => '3',
        'id_type.required' => 'Vui lòng chọn loại sản phẩm',
        'id_brand.required' => 'Vui lòng chọn hãng sản phẩm',
        'id_provider.required' => 'Vui lòng chọn nhà cung cấp sản phẩm',
        'description.required' => 'Vui lòng ciết mô tả cho sản phẩm',
        'regular_price.required' => 'Vui lòng nhập giá gốc cho sản phẩm',
        'regular_price.numeric' => 'Giá gốc của sản phẩm phải là số',
        'sale_price.numeric' => 'Giá sale của sản phẩm phải là số',
      ]);
      $product = new product;
      $product->name = $request->name;
      $product->id_type = $request->id_type;
      $product->id_brand = $request->id_brand;
      $product->id_provider = $request->id_provider;
      $product->description = $request->description;
      $product->regular_price = $request->regular_price;
      $product->sale_price = $request->sale_price;
      $product->save();

      $path= public_path('upload/product/');
      //upload files
        foreach ($request->file('image') as $file) {
          $product_images = new product_images;
          $image = $file->getClientOriginalName();
            while (file_exists($path.$image)) {
              $image = 'img_'.time().'_'.$file->getClientOriginalName();
            }
          $file->move($path,$image);

          $product_images->image = $image;
          $product_images->id_product = $product->id;
          $product_images->save();
        }
      return redirect('admin/product/add')->with('notify','Thêm thành công!');
    }

    public function getEdit($id){
      $product = product::find($id);
      $type_product = type_product::all();
      $brand = brand::all();
      $provider = provider::all();
      return view('admin.product.edit',['product'=>$product,'type_product'=>$type_product,'brand'=>$brand,'provider'=>$provider]);
    }
    public function postEdit(Request $request, $id){
      $product = product::find($id);
      $this->validate($request,[
        'name' => 'required',
        'id_type' => 'required',
        'id_brand' => 'required',
        'id_provider' => 'required',
        'description' => 'required',
        'regular_price' => 'required|numeric',
        'sale_price' => 'numeric|nullable',
        'image.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
      ],
      [
        'name.required' => ' Vui lòng nhập tên cho sản phẩm',
        'id_type.required' => 'Vui lòng chọn loại sản phẩm',
        'id_brand.required' => 'Vui lòng chọn hãng sản phẩm',
        'id_provider.required' => 'Vui lòng chọn nhà cung cấp sản phẩm',
        'description.required' => 'Vui lòng ciết mô tả cho sản phẩm',
        'regular_price.required' => 'Vui lòng nhập giá gốc cho sản phẩm',
        'regular_price.numeric' => 'Giá gốc của sản phẩm phải là số',
        'sale_price.numeric' => 'Giá sale của sản phẩm phải là số',
        'image.image' => '1',
        'image.mimes' => '2',
        'image.max' => '3'
      ]);

      $product->name = $request->name;
      $product->id_type = $request->id_type;
      $product->id_brand = $request->id_brand;
      $product->id_provider = $request->id_provider;
      $product->description = $request->description;
      $product->regular_price = $request->regular_price;
      $product->sale_price = $request->sale_price;


      //upload and delete old images if hasFile
      // how to delete old images
      if ($request->hasFile('image')) {

        // delete old images from folder
        $path= public_path('upload/product/');
        $product_images = $product->linktoimage;
        foreach ($product_images as $product_image)
        {
          $old_image =  $product_image->image;
          File::delete($path.$old_image);
        }
        // update product_images in DB
        $product_images = product_images::where('id_product',$product->id);

        // // $product_images->delete();
        // foreach ($product_images as $key ) {
        //   echo $key->image;
        // }
        //
        //

        // dd($product_images->image);

        $product_images->delete();
        foreach ($request->file('image') as $file) {

          $product_images = new product_images;
          $image = $file->getClientOriginalName();
            while (file_exists($path.$image)) {
              $image = 'img_'.time().'_'.$file->getClientOriginalName();
            }
          $file->move($path,$image);

          $product_images->image = $image;
          $product_images->id_product = $product->id;
          $product_images->save();
        }
      }
      $product->save();
      return redirect('admin/product/edit/'.$id)->with('notify', 'Sửa thành công!');
    }

    // public function getDelete($id){
    //   // $product = product::find($id);
    //   // $product_images = product_images::where('id_product',$id);
    //   $path= public_path('upload/product/');
    //   // File::delete($path,$product_images);
    //   // $product_images->delete();
    //   // $product->delete();
    //   // return redirect('admin/product/list')->with('notify', 'Xóa thành công!');
    //   $product = product::find($id);
    //   $product_images = $product->linktoimage;
    //   // dd($product_images->image);
    //   foreach ($product_images as $product_image)
    //   {
    //     $p1 =  ($product_image->image);
    //     File::delete($path.$p1);
    //     // $product_images->delete();
    //   }
    //
    //   $product->delete();
    //   return redirect('admin/product/list')->with('notify', 'Xóa thành công!');
    //   }

    public function getDelete($id){
      $path= public_path('upload/product/');
      $product = product::find($id);
      $product_images = $product->linktoimage;
      foreach ($product_images as $product_image)
      {
        $p1 =  ($product_image->image);
        File::delete($path.$p1);
        // $product_images->delete();
      }
      $product->status = 0;
      $product->save();
      return redirect('admin/product/list')->with('notify', 'Xóa thành công!');
    }

}
