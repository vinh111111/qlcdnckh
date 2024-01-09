@extends('posts.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('posts')
    <div class="custom-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Thêm đề án</h4>
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
                            <form action="{{route('postPostAdd')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên đề án:</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Người thực hiện:</label>
                                    <input type="text" class="form-control" name="implementer">
                                </div>
                                <div class="form-group">
                                    <label>Loại đề án:</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="id_type">
                                        @isset($typeprojects)
                                            @foreach($typeprojects as $typeproject)
                                                <option value="{{$typeproject->id}}">{{$typeproject->name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh:</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image" onchange="previewImage(this);">
                                        <label class="custom-file-label" for="customFile" >Chọn tập tin</label>
                                    </div>
                                </div>
                                <div class="form-group" style="height: 200px;">
                                    <label>Hình ảnh được chọn:</label>
                                    <div style="display:flex;flex-direction:column;">
                                        <img id="preview" width="200" height="50" style="position: absolute;width: 200px;height: 150px;display: block;background-size: cover;" class="img-thumbnail"/>
                                    </div>                                 
                                </div>
                                <div class="form-group">
                                    <label>Đường dẩn báo cáo:</label>
                                    <input type="url" class="form-control" name="report_link">
                                </div>
                                <div class="form-group">
                                    <label>Đường dẩn đến sản phẩm:</label>
                                    <input type="url" class="form-control" name="product_link">
                                </div>        
                                <div class="form-group">
                                    <label>Đường dẩn đến ứng dụng:</label>
                                    <input type="url" class="form-control" name="application_link">
                                </div>                       
                                <div class="form-group">
                                    <label>Giới thiệu:</label>
                                    <textarea class="form-control" rows="4" name="summary"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                                <a href="{{ route('getPost') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
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