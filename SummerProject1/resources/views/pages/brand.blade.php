@extends('layout.index')
@section('content')
  <div class="content">
      <div class="container">
        <div class="wrap-item">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">{{$brand_product->name}}</a></li>
          </ol>
          <div class="row">
            @foreach ($product as $p)
              <div
              @if ($p->status == 0)
                {{ 'hidden' }}
              @endif class="col-sm-3">
                <div class="card-group">
                  <div class="card">
                    <?php
                      $data = $p->linktoimage->take(10);
                      $image1 = $data->shift();
                     ?>
                      <img style="width:100%" src="upload/product/{{$image1['image']}}" alt="">
                    <div class="card-block">
                      <h5 class="card-title text-xs-center">{{$p->name}}</h5>
                      <div class="row">
                        @if ($p->sale_price > 0)
                        <div class="col-sm-4">
                            <p class="card-text price1">{{number_format($p->sale_price)}}</p>
                        </div>
                        <div class="col-sm-4">
                          <del><p class="card-text text-muted price2">{{number_format($p->regular_price)}}</p></del>
                        </div>
                        @else
                        <div class="col-sm-4">
                          <p class="card-text price1">{{number_format($p->regular_price)}}</p>
                        </div>
                        <div class="col-sm-4">
                        </div>
                        @endif
                        <div class="col-sm-4">
                          <div class="row">
                            <div class="col-sm-6">
                              <a href="addtoCart/{{$p->id}}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-shopping-cart"></i>
                              </a>
                            </div>
                            <div class="col-sm-6">
                              <a href="detail/{{$p->id}}" class="btn btn-sm btn-outline-primary">
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
           <div class="col-sm-8 col-sm-push-2">
               {{ $product->links() }}
           </div>
        </div>
      </div>
  </div> <!--end content-->

@endsection
