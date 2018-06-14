@extends('layout.index')
@section('content')
  <div class="content">
    <div class="container">
      <div class="wrap-item">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Sản phẩm mới</a></li>
        </ol>
        <div class="row">
          @foreach ($new_product as $np)
            <div
            @if ($np->status == 0)
              {{ 'hidden' }}
            @endif class="col-sm-3">
              <div class="card-group">
                <div class="card">
                  <?php
                    $data = $np->linktoimage->take(10);
                    $image1 = $data->shift();
                   ?>
                    <img style="width:100%" src="upload/product/{{$image1['image']}}" alt="{{$image1['image']}}">
                  <div class="card-block">
                      <p class="card-title text-xs-center">{{$np->name}}</p>
                    <div class="row">
                      @if ($np->sale_price > 0)
                      <div class="col-sm-4">
                          <p class="card-text price1">{{number_format($np->sale_price)}}</p>
                      </div>
                      <div class="col-sm-4">
                        <del><p class="card-text text-muted price2">{{number_format($np->regular_price)}}</p></del>
                      </div>
                      @else
                      <div class="col-sm-4">
                        <p class="card-text price1">{{number_format($np->regular_price)}}</p>
                      </div>
                      <div class="col-sm-4">

                      </div>
                      @endif
                      <div class="col-sm-4">
                        <div class="row">
                          <div class="col-sm-6">
                            <a href="addtoCart/{{$np->id}}" class="btn btn-sm btn-outline-primary">
                              <i class="fa fa-shopping-cart"></i>
                            </a>
                          </div>
                          <div class="col-sm-6">
                            <a href="detail/{{$np->id}}" class="btn btn-sm btn-outline-primary">
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
      <br>
      <div class="wrap-item">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a>Sản phẩm hạ giá</a></li>
        </ol>
        <div class="row">
          @foreach ($sale_product as $sp)
            <div
            @if ($sp->status == 0)
              {{ 'hidden' }}
            @endif class="col-sm-3">
              <div class="card-group">
                <div class="card">
                  <?php
                    $data = $sp->linktoimage->take(4);
                    $image2 = $data->shift();
                   ?>
                    <img style="width:100%" src="upload/product/{{$image2['image']}}" alt="{{$image2->image}}">
                  <div class="card-block">
                    <p class="card-title text-xs-center">{{$sp->name}}</p>
                    <div class="row">
                      @if ($sp->sale_price > 0)
                      <div class="col-sm-4">
                          <p class="card-text price1">{{number_format($sp->sale_price)}}</p>
                      </div>
                      <div class="col-sm-4">
                        <del><p class="card-text text-muted price2 ">{{number_format($sp->regular_price)}}</p></del>
                      </div>
                      @else
                      <div class="col-sm-4">
                        <p class="card-text price1">{{number_format($sp->regular_price)}}</p>
                      </div>
                      <div class="col-sm-4">

                      </div>
                      @endif
                      <div class="col-sm-4">
                        <div class="row">
                          <div class="col-sm-6">
                            <a href="addtoCart/{{$sp->id}}" class="btn btn-sm btn-outline-primary">
                              <i class="fa fa-shopping-cart"></i>
                            </a>
                          </div>
                          <div class="col-sm-6">
                            <a href="detail/{{$sp->id}}" class="btn btn-sm btn-outline-primary">
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
    </div> <!--end content-->
@endsection
