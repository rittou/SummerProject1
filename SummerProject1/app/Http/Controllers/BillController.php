<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bill;
use App\payment;
use App\bill_detail;
use App\product;

class BillController extends Controller
{
    public function getList(){
      $bill = bill::all();
      return view('admin.bill.list',['bill'=>$bill]);
    }
    public function getDetail(Request $request ){
      $id = $request->id;
      $bill_detail = bill_detail::where('id_bill',$id)->get();
      return view('admin.bill.detail',['bill_detail'=>$bill_detail]);
    }
    public function getEdit($id){
      $bill = bill::find($id);
      $payment = payment::find($bill->id_payment);
      return view('admin.bill.edit',['bill'=>$bill,'payment'=>$payment]);
    }
    public function postEdit(Request $request, $id)
    {
      $bill = bill::find($id);
      $bill->status = $request->status;
      $bill->save();
      return redirect('admin/bill/edit/'.$id)->with('notify', 'Sửa thành công');
    }
}
