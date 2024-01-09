@extends('admin.approve-view.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('approve-view')
    <div class="custom-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Duyệt đề án</h4>
                           </div>
                        </div>
                        @if ($errors->any())
                           <div class="alert alert-danger">
                              <ul>
                                 @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                 @endforeach
                              </ul>
                           </div>
                        @endif
                        <div class="iq-card-body">
                            <div class="form-group">
                                <label>Tên đề án:</label>
                                <input type="text" class="form-control" name="name-project" value="{{isset($requests->Project->name)?$requests->Project->name:''}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Người yêu cầu:</label>
                                <input type="text" class="form-control" name="name-user" value="{{isset($requests->User->name)?$requests->User->name:''}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="text" class="form-control" name="name-user" value="{{isset($requests->email)?$requests->email:''}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Loại:</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="type" disabled>
                                    <option>{{$requests->type}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="status" disabled>
                                    <option>{{$requests->status}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Đường dẩn:</label>
                                <input type="url" class="form-control" name="link" value="{{isset($requests->link)?$requests->link:''}}"disabled>
                            </div> 
                            <form action="{{route('admin.postApproveOrCancelView',$requests->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put') 
                                @if($requests->status == "Đang chờ được duyệt")
                                    <button type="submit" class="btn btn-primary" name="action" value="approve">Đồng ý</button>
                                    <button type="submit" class="btn btn-secondary" name="action" value="cancel">Từ chối</button>
                                @endif
                                <a href="{{ route('admin.getApproveViewList') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
                            </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('ad/js/preview-img.js')}}"></script>
    <script src="{{asset('ad/js/jquery.min.js')}}"></script>
    <script src="{{asset('ad/js/popper.min.js')}}"></script>
    <script src="{{asset('ad/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('ad/js/jquery.appear.js')}}"></script>
    <script src="{{asset('ad/js/countdown.min.js')}}"></script>
    <script src="{{asset('ad/js/waypoints.min.js')}}"></script>
    <script src="{{asset('ad/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('ad/js/wow.min.js')}}"></script>
    <script src="{{asset('ad/js/apexcharts.js')}}"></script>
    <script src="{{asset('ad/js/slick.min.js')}}"></script>
    <script src="{{asset('ad/js/select2.min.js')}}"></script>
    <script src="{{asset('ad/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('ad/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('ad/js/smooth-scrollbar.js')}}"></script>
    <script src="{{asset('ad/js/lottie.js')}}"></script>
    <script src="{{asset('ad/js/core.js')}}"></script>
    <script src="{{asset('ad/js/charts.js')}}"></script>
    <script src="{{asset('ad/js/animated.js')}}"></script>
    <script src="{{asset('ad/js/kelly.js')}}"></script>
    <script src="{{asset('ad/js/maps.js')}}"></script>
    <script src="{{asset('ad/js/worldLow.js')}}"></script>
    <script src="{{asset('ad/js/raphael-min.js')}}"></script>
    <script src="{{asset('ad/js/morris.js')}}"></script>
    <script src="{{asset('ad/js/morris.min.js')}}"></script>
    <script src="{{asset('ad/js/flatpickr.js')}}"></script>
    <script src="{{asset('ad/js/style-customizer.js')}}"></script>
    <script src="{{asset('ad/js/chart-custom.js')}}"></script>
    <script src="{{asset('ad/js/custom.js')}}"></script>
@endsection