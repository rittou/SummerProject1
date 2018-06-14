<div class="menu">
  <nav class="navbar navbar-fixed-top">
    <div class="logo"><a class="navbar-brand" href="homepage">Rittou</a></div>
    <ul class=" menu-left nav navbar-nav pull-left">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              Danh mục
          </a>
          <div class="dropdown-menu dropdown-menu-left">
            <div class="container">
              <div class="row">
                  @foreach ($type as $t)
                    <div @if ($t->status == 0)
                      {{ 'hidden' }}
                    @endif class="col-sm-3 ">
                      <div class="row no-gutters">
                        <div class="col-sm-3">
                          <img style="width:100%" src="upload/product/{{$t->image}}" alt="">
                        </div>
                        <div class="col-sm-9">
                            <a href="category/{{$t->id}}" class="dropdown-item">{{$t->name}}</a>
                        </div>
                      </div>
                    </div>
                  @endforeach
              </div>
            </div>
          </div>
      </li> <!--end categories-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            Thương hiệu
        </a>
        <div class="dropdown-menu dropdown-menu-left">
          <div class="container">
              <div class="row">
          @foreach ($brand as $b)
                <div @if ($b->status == 0)
                  {{ 'hidden' }}
                @endif class="col-sm-2">
                  <a class="dropdown-item" href="brand/{{$b->id}}">{{$b->name}}</a>
                </div>
          @endforeach
              </div>
            </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link cometocontact" >Liên hệ</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li> -->
    </ul> <!--end menu-left-->
    <ul class="menu-right nav navbar-nav pull-right">
      <li class="search nav-item">
        <form class="navbar-form" action="search" method="post">
          <input type="hidden" name="_token" value="{{csrf_token('')}}">
          <div class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Nhập từ khóa tìm kiếm...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="submit">Tìm kiếm</button>
            </span>
          </div>
        </form>
      </li>
      <li class="nav-item cart">
        <a class="nav-link" href="cart"><i class="fa fa-shopping-basket"></i>({{Cart::count()}})</a>
      </li> <!--end cart-->
      @if (Auth::check())
        <li class="nav-item">
          <div class="row">
            <div class="col-xs-3">
              <a class="nav-link" data-toggle="dropdown" id="dropdownMenu1" aria-expanded="false">
                <img class="profile" src="upload/users/{{Auth::user()->image}}" alt="">
              </a>
              <div class="dropdown-menu dropdown-menu-right drop-by-me" aria-labelledby="dropdownMenu1">
                <a class="dropdown-item" href="profile">Thông tin cá nhân</a>
                <a class="dropdown-item" href="orderList">Theo dõi đơn hàng</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout">Đăng xuất</a>
              </div>
            </div>
            <div class="col-xs-9">
              <a class="nav-link">
                {{Auth::user()->displayname}}
              </a>
            </div>
          </div>
        </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="login"><i class="fa fa-user-circle"></i>Đăng nhập</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup"><i class="fa fa-user-circle"></i>Đăng ký</a>
          </li>
      @endif
    </ul><!--end menu-right-->
  </nav><!--end nav-->
</div> <!--end menu-->
