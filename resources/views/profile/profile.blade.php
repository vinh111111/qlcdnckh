@extends('profile.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('profile')
@isset($user)
    <div class="custom-wrapper">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                <div class="iq-card-body p-0">
                    <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                            <li class="col-md-6 p-0">
                            <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                Thông tin cá nhân
                            </a>
                            </li>
                            <li class="col-md-6 p-0">
                            <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                Đổi mật khẩu
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Thông tin cá nhân</h4>
                            </div>
                            </div>
                            <div class="iq-card-body">
                            <form action="{{route('postEditprofile',$user->id)}}" method="post" enctype="multipart/form-data">
                                @if(session('success1'))
                                    <div class="alert alert-success">
                                        {{ session('success1') }}
                                    </div>
                                @endif                              
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @csrf                              
                                <div class="form-group row align-items-center">
                                    <div class="col-md-12">
                                        <div class="profile-img-edit" style="width: 150px;height: 150px;border: radius 100px; overflow:hidden; justify-content:space-between;align-items:center">
                                        @if($user->image != "daidien.jpg")
                                            <img class="profile-pic" src="{{ asset('/theme/image/users/'.$user->image) }}" style="position: relative; width: 150px;height: 150px;border: radius 100px;" alt="profile-pic">
                                        @else
                                            <img class="profile-pic" src="{{asset('/theme/image/'.$user->image)}}" style="position: relative; width: 150px;height: 150px;border: radius 100px;" alt="profile-pic">
                                        @endif
                                        <div class="p-image" >
                                            <i class="fas fa-pen upload-button"></i>
                                            <input class="file-upload"  type="file" name="image" style="position: relative; width: 150px;height: 150px;border: radius 100px;"   accept="image/*" />
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="name">Họ tên:</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{isset( $user->name)?$user->name:''}}">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="text" class="form-control" name="phone" value="{{ isset($user->phone)?$user->phone:'' }}">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" value="{{ isset($user->email)?$user->email:'' }}" disabled>
                                </div>
                                <button type="submit" style="margin-left: 15px;" class="btn btn-primary mr-2">Gửi</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Đổi mật khẩu</h4>
                            </div>
                            </div>
                            <div class="iq-card-body">
                            <form action="{{route('changepassword',$user->id)}}" method="post">
                                @if(session('success2'))
                                    <div class="alert alert-success">
                                        {{ session('success2') }}
                                    </div>
                                @endif      
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif                         
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <label for="old_password">Mật khẩu hiện tại:</label>
                                    <input type="password" class="form-control" name="old_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Mật khẩu mới:</label>
                                    <input type="password" class="form-control" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="re_new_password">Xác nhận lại mật khẩu:</label>
                                    <input type="password" class="form-control" name="re_new_password" required>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Gửi</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endisset
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