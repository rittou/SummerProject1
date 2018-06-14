<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\provider;
use App\input_sheet;
use App\input_sheet_detail;
use Illuminate\Support\Facades\Auth;
use App\product;

class InputSheetController extends Controller
{
    public function getList(){
      $input_sheet = input_sheet::all();
      return view('admin/input_sheet/list',['input_sheet'=>$input_sheet]);
    }

    public function getProviderChoose(){
      $provider = provider::all();
    return view('admin.input_sheet.providerChoose',['provider'=>$provider]);
    }

    public function getProductList(Request $request){
      $id_provider = $request->id_provider;
      $provider = provider::find($id_provider);
      $product = product::where('id_provider',$id_provider)->get();
      return view('admin/input_sheet/productList',['provider'=>$provider,'product'=>$product]);
    }

    public function getAdd(Request $request){
      $id_product = $request->id;
      $product = product::find($id_product);
      return view('admin/input_sheet/add',['product'=>$product]);
    }

    public function postAdd(Request $request, $id){
      $product = product::find($id);
      $current_qty = $product->quantity;
      $this->validate($request,
      [
        'price' => 'required',
        'quantity' => 'required',
        'input_date' => ' required'
      ],
      [
        'price.required' => 'Vui lòng nhập giá nhập của sản phẩm',
        'quantity.required' => 'Vui lòng nhập số lượng nhập của sản phẩm',
        'input_date' => 'Vui lòng nhập ngày nhập sản phẩm'
      ]);
      $input_sheet = new input_sheet;
      $input_sheet->id_provider = $product->linktoprovider->id;
      $input_sheet->id_admin = Auth::guard('admin')->user()->id;
      $input_sheet->total = $request->quantity * $request->price;
      $input_sheet->input_date = $request->input_date;
      $input_sheet->save();

      $input_sheet_detail = new input_sheet_detail;
      $input_sheet_detail->id_input_sheet = $input_sheet->id;
      $input_sheet_detail->product = $product->name;
      $input_sheet_detail->price = $request->price;
      $input_sheet_detail->quantity = $request->quantity;
      $product->quantity = $current_qty + $request->quantity;
      $product->save();
      $input_sheet_detail->save();


      return redirect('admin/input_sheet/add/'.$id)->with('notify', 'Lập phiếu nhập thành công');
    }
}
