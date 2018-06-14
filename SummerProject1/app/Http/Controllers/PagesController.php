<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\type_product;
use App\product;
use App\product_images;
use App\comment;
use App\brand;
use App\User;
use App\bill;
use App\bill_detail;
use App\payment;
use App\message;
use Mail;
use App\mail\SendMail;

class PagesController extends Controller
{
    function __construct(){
      $brand = brand::all();
      $type = type_product::all();
      return view()->share(['type'=>$type,'brand'=>$brand]);
    }

    public function homepage(){
      $new_product = product::orderBy('created_at','desc')->take(20)->get();
      $sale_product = product::where('sale_price','<>','0')->take(20)->orderBy('updated_at','desc')->get();
      return view('pages.homepage',['new_product'=>$new_product,'sale_product'=>$sale_product]);
    }


    public function category($id){
      $type_product = type_product::find($id);
      $product = product::where('id_type',$id)->paginate(8);
      return view('pages.category',['type_product'=>$type_product,'product'=>$product]);
    }
    public function brand($id){
      $brand_product = brand::find($id);
      $product = product::where('id_brand',$id)->paginate(8);
      return view('pages.brand',['brand_product'=>$brand_product,'product'=>$product]);
    }

    public function detail($id){
      $product = product::find($id);
      $id_type = $product->id_type;
      $id_brand = $product->id_brand;
      $comment = comment::where('id_product',$id);
      $related_type = product::where('id_type',$id_type)->where('id','<>',$id)->take(10)->get();
      $related_brand = product::where('id_brand',$id_brand)->where('id','<>',$id)->take(10)->get();
      return view('pages.detail',['product'=>$product,'comment'=>$comment,'related_type'=>$related_type,'related_brand'=>$related_brand]);
    }

    public function search(Request $request){
      $keyword = $request->keyword;
      $product = product::where('name','like',"%$keyword%")->get();
      return view('pages.search',['keyword'=>$keyword,'product'=>$product]);
    }

    public function getLogin(){
      return view('layout.login');
    }
    public function postLogin(Request $request){
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
      if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
        return redirect('homepage');
      }else {
        return redirect('login')->with('notify', 'Đăng nhập không thành công!');
      }
    }

    public function getSignup(){
      return view('layout.signup');
    }
    public function postSignup(Request $request){
      $this->validate($request,
      [
        'name' => 'required',
        'displayname' => 'required',
        'email' =>'required|email|unique:users,email',
        'password' => 'required|min:6|max:32',
        'passwordAgain' => 'required|same:password',
        'phone_number' => 'required|min:10|max:11',
        'address' => 'required',
        'image' => 'required|mimes:jpg,jpeg,png'
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
        'image.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg hoặc png'
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
        Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
    return redirect('signup')->with('notify', 'Đăng ký thành công!');

    }

    public function getLogout(){
      Auth::logout();
      return redirect('homepage');
    }

    public function getProfile(){
      return view('layout.profile');
    }
    public function postProfile(Request $request){
      $user = Auth::user();
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
    return redirect('profile')->with('notify', 'Sửa thành công');
    }

    public function getOrderList(){
      $user = Auth::user();
      // $uid = $user->id;
      // $bill = bill::find($uid);
      // dd($bill);
      // $bill_detail = bill_detail::find($bill->id);
      return view('layout.orderList');
    }

    public function getOrderListDetail(Request $request)
    {
     $id = $request->id;
     $bill_detail = bill_detail::where('id_bill',$id)->get();
     return view('layout.orderListDetail',['bill_detail'=>$bill_detail]);
    }

    public function getorderCancel (Request $request)
    {
      $bill = bill::find($request->id);
      $bill->status = 0;
      $bill_detail = bill_detail::find($bill->id);
      foreach ($bill_detail as $bd) {
        $pid = $bd->id_product;
        $product = product::find($pid);
        $product->quantity = $product->quantity + $bd->quantity;
        $product->save();
      }
      $bill->save();
    }


    public function getCart(){
      $content = Cart::content();
      // print_r($content);
      $total = Cart::subtotal(0,'.',',');
      return view('layout.cart',['content'=>$content,'total'=>$total]);
    }

    public function getaddtoCart($id){
      $product = product::find($id);
        if ($product->quantity > 0) {
          $product_images = product_images::where('id_product',$product->id)->first();
          if ($product->sale_price > 0) {
            Cart::add(['id'=>$product->id,'name'=>$product->name, 'qty'=>1, 'price'=>$product->sale_price,'options' => ['image'=>$product_images->image]]);
          }else {
            Cart::add(['id'=>$product->id,'name'=>$product->name, 'qty'=>1, 'price'=>$product->regular_price,'options' => ['image'=>$product_images->image]]);
          }
          $content = Cart::content();
          $product->quantity = $product->quantity - 1;
          $product->save();
          // dd($content);
          return redirect('cart');
        }else {
          return redirect('cart')->with('notify', 'Hàng đã hết!');
        }

      }

    public function updateCart(Request $request){
          $id = $request->id;
          $qty = $request->qty;
          // Cart::update($id,$qty);
          $content = Cart::content();
          foreach ($content as $c) {
            $pid = $c->id;
            $product = product::find($pid);
            if ($qty > $product->quantity) {
              return redirect('cart')->with('notify', 'Số lượng hàng còn lại không đủ');
            }else {
              $cart_qty = $c->qty;
              $product->quantity = $product->quantity + $cart_qty - $qty;
              Cart::update($id,$qty);
              $product->save();
            }
          }

    }

    public function removefromCart(Request $request){
      $id = $request->id;
      $content = Cart::content();
      foreach ($content as $c) {
        $pid = $c->id;
        $product = product::find($pid);
        $cart_qty = $c->qty;
        $product->quantity = $product->quantity + $cart_qty;
        Cart::remove($id);
        $product->save();
      }

    }

    public function getOrder(){
      $content = Cart::content();
      $total = Cart::subtotal(0,'.',',');
      $payment = payment::all();
      return view('layout.order',['content'=>$content,'total'=>$total,'payment'=>$payment]);
    }

    public function shipping(Request $request){
      if($request->id_payment == 1){
        $bill = new bill;
        if (Auth::check()) {
            $bill->id_users = Auth::user()->id;
            $bill->name = Auth::user()->name;
            $bill->email = Auth::user()->email;
            if ($request->changeAddress == "on") {
              $bill->order_address =  $request->order_address;
            }else {
              $bill->order_address = Auth::user()->address;
            }
            $bill->phone_number = Auth::user()->phone_number;
        }
        else
        {
          $this->validate($request,
          [
            'email' => 'required|email',
            'name' => 'required',
            'order_address' => 'required',
            'phone_number' => 'required|min:10|max:11',
          ],
          [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'name.required' => 'Vui lòng nhập họ và tên của bạn',
            'order_address.required' => 'Vui lòng nhập địa chỉ chính xác để giao hàng',
            'phone_number.required' => 'Vui lòng nhập sđt liên lạc',
            'phone_number.min' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
            'phone_number.max' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
          ]);
          $bill->email = $request->email;
          $bill->name = $request->name;
          $bill->order_address = $request->order_address;
          $bill->phone_number = $request->phone_number;
        }
        $bill->order_date = date('Y-m-d H:i:s');
        $bill->id_payment = $request->id_payment;
        $bill->total = Cart::subtotal(0,',','');

        $bill->save();

        $content = Cart::content();
        foreach ($content as $c) {
          $bill_detail = new bill_detail;
          $bill_detail->id_bill = $bill->id;
          $bill_detail->id_product = $c->id;
          $bill_detail->quantity = $c->qty;
          $bill_detail->price = $c->price;
          $bill_detail->save();
          $product = product::find($bill_detail->id_product);
          $current_qty = $product->quantity;
          $product->quantity = $current_qty - $bill_detail->quantity;
          $product->save();
        }

        $payment = payment::find($bill->id_payment);
        // $product = product::find($bill_detail->id_product);
        if (Auth::check()) {
          Mail::to(Auth::user()->email)->send(new SendMail($bill, $payment));
        }else {
          Mail::to($request->email)->send(new SendMail($bill, $payment));
        }
        Cart::destroy();
        return redirect('order_complete');
      }
      else if($request->id_payment == 2){
        $bill = new bill;
        if (Auth::check()) {
            $bill->id_users = Auth::user()->id;
            $bill->name = Auth::user()->name;
            $bill->email = Auth::user()->email;
            if ($request->changeAddress == "on") {
              $bill->order_address =  $request->order_address;
            }else {
              $bill->order_address = Auth::user()->address;
            }
            $bill->phone_number = Auth::user()->phone_number;
        }
        else
        {
          $this->validate($request,
          [
            'email' => 'required|email',
            'name' => 'required',
            'order_address' => 'required',
            'phone_number' => 'required|min:10|max:11',
          ],
          [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'name.required' => 'Vui lòng nhập họ và tên của bạn',
            'order_address.required' => 'Vui lòng nhập địa chỉ chính xác để giao hàng',
            'phone_number.required' => 'Vui lòng nhập sđt liên lạc',
            'phone_number.min' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
            'phone_number.max' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
          ]);
          $bill->email = $request->email;
          $bill->name = $request->name;
          $bill->order_address = $request->order_address;
          $bill->phone_number = $request->phone_number;
        }
        $bill->order_date = date('Y-m-d H:i:s');
        $bill->id_payment = $request->id_payment;
        $bill->total = Cart::subtotal(0,',','');

        $bill->save();

        $content = Cart::content();
        foreach ($content as $c) {
          $bill_detail = new bill_detail;
          $bill_detail->id_bill = $bill->id;
          $bill_detail->id_product = $c->id;
          $bill_detail->quantity = $c->qty;
          $bill_detail->price = $c->price;
          $bill_detail->save();
          $product = product::find($bill_detail->id_product);
          $current_qty = $product->quantity;
          $product->quantity = $current_qty - $bill_detail->quantity;
          $product->save();
        }

        $payment = payment::find($bill->id_payment);
        $product = product::find($bill_detail->id_product);
        if (Auth::check()) {
          Mail::to(Auth::user()->email)->send(new SendMail($bill, $payment));
        }else {
          Mail::to($request->email)->send(new SendMail($bill, $payment));
        }
        // Cart::destroy();
        $total = Cart::subtotal(0,',','');
        return view('layout.paypal',['content'=>$content,'total'=>$total,'id'=>$bill->id]);
      }

    }



    public function getOrderComplete(){
      Cart::destroy();
      return view('layout.order_complete');
    }

    public function getOrderFail($id){
      $bill = bill::find($id);
      $bill_detail = bill_detail::find($bill->id);
      $product = product::find($bill_detail->id_product);
      $current_qty = $product->quantity;
      $product->quantity = $current_qty + $bill_detail->quantity;
      $bill_detail->delete();
      $bill->delete();
      return view('layout.loi');
    }




    public function comment(Request $request, $id){
      $this->validate($request,
      [
        'content' => 'required|min:13'
      ],
      [
        'content.required' => 'Vui lòng nhập nội dung bình luận',
        'content.min' => 'Nội dung tối thiểu phải có 13 ký tự'
      ]);
      $comment = new comment;
      $comment->id_User = Auth::user()->id;
      $comment->id_product = $id;
      $comment->content = $request->content;

      $comment->save();
      return redirect('detail/'.$id)->with('notify', 'Thêm bình luận thành công');
    }

    public function message(Request $request){
      $this->validate($request,
      [ 'name' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|min:10|max:11',
        'content' => 'required|min:13'
      ],
      [ 'name.required' => "Vui lòng nhập tên",
        'email.required' => 'Vui lòng nhập email',
        'email.email' => 'Email không hợp lệ',
        'phone_number.required' => 'Vui lòng nhập số điện thoại',
        'phone_number.min' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
        'phone_number.max' => 'SĐT của bạn phải từ 10 đến 11 chữ số',
        'content.required' => 'Vui lòng nhập nội dung bình luận',
        'content.min' => 'Nội dung tối thiểu phải có 13 ký tự'
      ]);

      $message = new message;
      $message->name = $request->name;
      $message->email = $request->email;
      $message->phone_number = $request->phone_number;
      $message->content = $request->content;

      $message->save();
      return redirect('homepage');
    }
}
