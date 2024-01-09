@extends('admin.users.layout.master')
@section('css')
   <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
   <link rel="stylesheet" href="{{asset('ad/css/typography.css')}}">
   <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
   <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('content')
      <div class="custom-wrapper">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Sửa danh mục</h4>
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
                     @isset($user)
                        <div class="iq-card-body">
                           <form method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                 <label>Tên người dùng:</label>
                                 <input type="text" name="name" value="{{isset($user[0]->name)?$user[0]->name:''}}" class="form-control" disabled>
                              </div>
                              <div class="form-group">
                                 <label>Email:</label>
                                 <input type="email" name="email" value="{{isset($user[0]->email)?$user[0]->email:''}}" class="form-control" disabled>
                              </div>
                              <div class="form-group">
                                 <label>Số điện thoại:</label>
                                 <input type="number" name="phone" value="{{isset($user[0]->phone)?$user[0]->phone:''}}" class="form-control" disabled>
                              </div>
                           </form>
                        </div>
                     @endisset
                  </div>
               </div>
            </div>
            @isset($post)
               @if(count($post) > 0)
                  @php
                     $i=1;
                     $ds=[];
                     if(isset($results))
                        $ds=$results;
                     else
                        $ds=$post;
                  @endphp
                  <div class="row">
                     <div class="col-12 col-m-12 col-sm-12">
                        <div class="custom-card">
                              <div class="custom-card-header">
                                 <h3>
                                    Bài viết 
                                 </h3>
                              </div>
                              <div class="custom-card-content">
                                 <table class="custom-table">
                                    <thead>
                                          <tr>
                                             <th>#</th>
                                             <th>Tên bài viết</th>
                                             <th>Người đăng</th>
                                             <th>Loại bài viết</th>
                                             <th>Người thực hiện</th>
                                             <th>Ngày đăng</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach($ds as $project)
                                             <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$project->name}}</td>
                                                <td>{{$project->User->name}}</td>
                                                <td>{{$project->Typeproject->name}}</td>
                                                <td>
                                                      {{$project->implementer}}
                                                </td>
                                                <td>{{ $project->created_at->format('d-m-Y') }}</td>
                                             </tr>
                                             @php
                                                $i=$i+1;
                                             @endphp
                                          @endforeach
                                    </tbody>
                                 </table>
                              </div>
                        </div>
                     </div>
                  </div>
               @endif
            @endisset
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