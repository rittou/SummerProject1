@extends('admin.layout.index')
@section('maincontent')

  <section id="main-content">
      <section class="wrapper">
  <div class="row ml-0">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-files-o"></i> Choose provider</h3>
  </div>
</div>
          <div class="row">
              <div class="col-lg-12">
                  <section class="panel">
                      {{-- <header class="panel-heading">
                        @if (count($errors)>0)
                           @foreach ($errors->all() as $e)
                             {{$e}}<br/>
                           @endforeach
                       @endif
                       @if (session('notify'))
                           {{session('notify')}}
                       @endif
                      </header> --}}
                      <div class="panel-body">
                          <div class="form">
                              <form class="form-validate form-horizontal"  method="get" action="admin/input_sheet/productList">
                                <input type="hidden" name="_token" value="{{csrf_token('')}}">
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Vui lòng chọn nhà cung cấp</label>
                                      <div class="col-lg-8">
                                          <select class="form-control" name="id_provider">
                                            @foreach ($provider as $p)
                                              <option
                                                @if ($p->status == 0)
                                                {{'hidden'}}
                                                @endif
                                              value="{{$p->id}}"> {{ $p->name }}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button class="btn btn-primary" type="submit">Show</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </section>
              </div>
          </div>
          <!-- page end-->
      </section>
  </section>

  <!--main content end-->

@endsection
