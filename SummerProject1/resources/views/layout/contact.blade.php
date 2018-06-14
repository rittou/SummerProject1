<div class="contact">
  <div class="address">
    <h2 class="text-sm-center">
      CONTACT
    </h2>
    <p class="text-sm-center">
      Adress: Đường Man Thiện, Phường Hiệp Phú, Quận 9, TP. Hồ Chí Minh <br>
      SĐT: (028) 38.295.258
    </p>
  </div> <!--end address-->
 <div class="message">
    <form class="form-validate form-horizontal" action="message" method="post">
      <input type="hidden" name="_token" value="{{csrf_token('')}}">
      <div class="container">
          @if (count($errors)>0)
          <div class="alert alert-danger text-xs-center">
            @foreach ($errors->all() as $e)
              {{$e}}<br/>
            @endforeach
          </div>
          @endif
          @if (session('notify1'))
          <div class="alert alert-success text-xs-center">
            {{session('notify1')}}
          </div>
          @endif
        <div class="row">
          <div class="col-sm-6">
            <fieldset class="form-group">
              <input type="text" name="name" class="form-control message1"  placeholder="Tên của bạn">
            </fieldset>
            <fieldset class="form-group">
              <input type="text" name="email" class="form-control message1"  placeholder="Email">
            </fieldset>
            <fieldset class="form-group">
              <input type="text" name="phone_number" class="form-control message1"  placeholder="Số điện thoại">
            </fieldset>
          </div>
          <div class="col-sm-6">
            <textarea name="content" class="form-control message2" rows="9" cols="80" placeholder="Góp ý hoặc nhận xét của bạn viết ở đây ..."></textarea>
          </div>
        </div>
        <div class="col-sm-3 push-sm-5"><button type="submit" class="btn btn-primary btnSend">Gửi</button></div>
      </div>
    </form>
  </div><!--end message-->
</div><!--end contact-->
