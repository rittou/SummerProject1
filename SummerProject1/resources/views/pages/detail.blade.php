@extends('layout.index')
@section('content')
  <div class="content">
    <div class="container">
      <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li class="breadcrumb-item"><a href="#">Chi tiết sản phẩm</a></li>
      </ol><!--end breadcrumb-->
      <?php
        $data = $product->linktoimage->take(5);
        $image1 = $data->shift();
       ?>
      <div class="row no-gutters">
        <div class="col-sm-6">
          <img style="width:100%" src="upload/product/{{$image1->image}}" alt="{{$image1->image}}">
          <hr/>
          <div class="row">
            @foreach ($data as $d)
              <div class="col-sm-4">
                <img style="width:100%" src="upload/product/{{$d->image}}" alt="{{$d->image}}">
              </div>
            @endforeach
          </div>
        </div>
        <div class="col-sm-6 jumbotron detailbox">
          <h4 class="text-sm-center">{{$product->name}}</h4>
          <hr/>
          <p class="describe">{{$product->description}}</p>
          <h4 style="margin-botton:10px">
            @if ($product->sale_price > 0)
            <div class="media">
              <div class="col-sm-4">
                  <p class="card-text">Price: </p>
              </div>
              <div class="col-sm-4 ">
                <p style="color:red">{{number_format($product->sale_price)}}</p>
              </div>
              <div class="col-sm-4">
                <del><p class="card-text text-muted">{{number_format($product->regular_price)}}</p></del>
              </div>
            </div>
            @else
            <div class="col-sm-4">
              <p class="card-text price1">Price:{{number_format($product->regular_price)}}</p>
            </div>
            <div class="col-sm-4">
            </div>
            @endif
          </h4>
          @if ($product->quantity > 0)
            <p class="ml-1">Tình trạng: Còn {{ $product->quantity }} sản phẩm</p>
          @else <p>Hết hàng</p>
          @endif

            <a href="addtoCart/{{$product->id}}"><button type="button" class=" ml-1 btn btn-primary">Thêm vào giỏ hàng</button></a>
        </div>
      </div> <!--end row-->

      <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#comment" role="tab">Bình luận</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#relate_type" role="tab">Sản phẩm liên quan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#related_brand" role="tab">Sản phẩm cùng thương hiệu</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="comment" role="tabpanel">
            <div class="discuss">
              @if (count($errors)>0)
              <div class="alert alert-danger">
                @foreach ($errors->all() as $e)
                  {{$e}}<br/>
                @endforeach
              </div>
            @endif
            @if (session('notify'))
              <div class="alert alert-success">
                {{session('notify')}}
              </div>
            @endif

            @if (Auth::check())
              <div class="container">
                <div class="well"><p class="lead">Viết bình luận</p>
                    <form role="form" action="comment/{{$product->id}}" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token('') }}">
                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
              </div>
            @else
              <a href="login">Đăng nhập để bình luận</a>
            @endif
                    <hr>
                <div class="container">
                  <div class="row mt-1">
                  @foreach ($product->linktocomment as $c)

                        <div class="col-sm-2">
                              <img style="width:100px;height:100px;border-radius:50%" src="upload/users/{{ $c->linktouser->image }}" alt="">
                        </div>
                        <div class="col-sm-4">
                            <h4>{{ $c->linktouser->displayname }}
                                <small class="muted-text">{{ $c->created_at }}</small>
                            </h4>
                              <span>{{ $c->content }}</span>
                        </div>

                  @endforeach
                  </div>
                </div>
            </div><!-- end discuss-->
          </div>
          <div class="tab-pane" id="relate_type" role="tabpanel">
            <div class="wrap-item">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sản phẩm liên quan</a></li>
              </ol>
              <div class="row">
                @foreach ($related_type as $rt)
                  <div
                  @if ($rt->status == 0)
                    {{ 'hidden' }}
                  @endif class="col-sm-3">
                    <div class="card-group">
                      <div class="card">
                        <?php
                          $data = $rt->linktoimage->take(10);
                          $image1 = $data->shift();
                         ?>
                          <img style="width:100%" src="upload/product/{{$image1['image']}}" alt="">
                        <div class="card-block">
                          <p class="card-title text-xs-center">{{$rt->name}}</p>
                          <div class="row">
                              @if ($rt->sale_price > 0)
                              <div class="col-sm-4">
                                  <p class="card-text price1">{{number_format($rt->sale_price)}}</p>
                              </div>
                              <div class="col-sm-4">
                                <del><p class="card-text text-muted price2">{{number_format($rt->regular_price)}}</p></del>
                              </div>
                              @else
                              <div class="col-sm-4">
                                <p class="card-text price1">{{number_format($rt->regular_price)}}</p>
                              </div>
                              <div class="col-sm-4">
                              </div>
                              @endif
                              <div class="col-sm-4">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <a href="addtoCart/{{$rt->id}}" class="btn btn-sm btn-outline-primary">
                                      <i class="fa fa-shopping-cart"></i>
                                    </a>
                                  </div>
                                  <div class="col-sm-6">
                                    <a href="detail/{{$rt->id}}" class="btn btn-sm btn-outline-primary">
                                      <i class="fa fa-eye"></i>
                                    </a>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="tab-pane" id="related_brand" role="tabpanel">
            <div class="wrap-item">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sản phẩm cùng thương hiệu</a></li>
              </ol>
              <div class="row">
                @foreach ($related_brand as $rb)
                  <div
                  @if ($rb->status == 0)
                    {{ 'hidden' }}
                  @endif class="col-sm-3">
                    <div class="card-group">
                      <div class="card">
                        <?php
                          $data = $rb->linktoimage->take(10);
                          $image1 = $data->shift();
                         ?>
                          <img style="width:100%" src="upload/product/{{$image1['image']}}" alt="">
                        <div class="card-block">
                          <p class="card-title text-xs-center">{{$rb->name}}</p>
                          <div class="row">
                              @if ($rb->sale_price > 0)
                              <div class="col-sm-4">
                                  <p class="card-text price1">{{number_format($rb->sale_price)}}</p>
                              </div>
                              <div class="col-sm-4">
                                <del><p class="card-text text-muted price2">{{number_format($rb->regular_price)}}</p></del>
                              </div>
                              @else
                              <div class="col-sm-4">
                                <p class="card-text price1">{{number_format($rb->regular_price)}}</p>
                              </div>
                              <div class="col-sm-4">
                              </div>
                              @endif
                              <div class="col-sm-4">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <a href="addtoCart/{{$rb->id}}" class="btn btn-sm btn-outline-primary">
                                      <i class="fa fa-shopping-cart"></i>
                                    </a>
                                  </div>
                                  <div class="col-sm-6">
                                    <a href="detail/{{$rb->id}}" class="btn btn-sm btn-outline-primary">
                                      <i class="fa fa-eye"></i>
                                    </a>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </div> <!--end container-->
  </div> <!--end content-->

@endsection
