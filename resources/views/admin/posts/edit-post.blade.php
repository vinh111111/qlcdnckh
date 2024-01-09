@extends('admin.posts.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('postads')
    <div class="custom-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Sửa đề án</h4>
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
                        @isset($project)
                            <div class="iq-card-body">
                                <form action="{{route('admin.postAdminPostEdit',$project)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label>Tên đề án:</label>
                                        <input type="text" class="form-control" name="name" value="{{isset($project->name)?$project->name:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Người đăng:</label>
                                        <input type="text" class="form-control" name="id_user" value="{{isset($project->id_user)?$project->User->name:''}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Người thực hiện:</label>
                                        <input type="text" class="form-control" name="implementer" value="{{isset($project->implementer)?$project->implementer:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Loại đề án:</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="id_type">
                                            <option value="{{$project->id_type}}">{{$project->Typeproject->name}}</option>
                                            @isset($typeprojects)
                                                @foreach($typeprojects as $typeproject)
                                                    @if($typeproject->id !== $project->id_type)
                                                        <option value="{{$typeproject->id}}">{{$typeproject->name}}</option>
                                                    @endif
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
                                        <label>Hình ảnh củ:</label>
                                        <div style="display:flex;flex-direction:column;">
                                            <img src="{{ asset('/theme/image/project/'.$project->image) }}" width="200" height="50" style="position: absolute;width: 200px;height: 150px;display: block;background-size: cover;" class="img-thumbnail"/>
                                        </div>                                 
                                    </div>
                                    <div class="form-group" style="height: 200px;">
                                        <label>Hình ảnh mới:</label>
                                        <div style="display:flex;flex-direction:column;">
                                            <img id="preview" width="200" height="50" style="position: absolute;width: 200px;height: 150px;display: block;background-size: cover;" class="img-thumbnail" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Đường dẩn báo cáo:</label>
                                        <input type="url" class="form-control" name="report_link" value="{{isset($project->report_link)?$project->report_link:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Đường dẩn đến sản phẩm:</label>
                                        <input type="url" class="form-control" name="product_link" value="{{isset($project->product_link)?$project->product_link:''}}">
                                    </div>        
                                    <div class="form-group">
                                        <label>Đường dẩn đến ứng dụng:</label>
                                        <input type="url" class="form-control" name="application_link" value="{{isset($project->application_link)?$project->application_link:''}}">
                                    </div>                       
                                    <div class="form-group">
                                        <label>Giới thiệu:</label>
                                        <textarea class="form-control" rows="4" name="summary">{{isset($project->summary)?$project->summary:''}}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Gửi</button>
                                    <a href="{{ route('admin.getAdminPost') }}" class="btn btn-danger"><font color="white">Trở lại</font></a>
                                </form>
                            </div>    
                        @endisset
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