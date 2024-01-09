@extends('admin.approve-view.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('approve-view')
    @isset($requestlist)
        @php
            $i=1;
            $ds=[];
            if(isset($results))
                $ds=$results;
            else
                $ds=$requestlist;
        @endphp
        <div class="custom-wrapper">
            @if(session('success'))
                <br>
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                <br>
            @endif
            <div class="row">
                <div class="col-12 col-m-12 col-sm-12">
                    <div class="custom-card">
                        <div class="custom-card-header">
                            <h3>
                                Danh sách yêu cầu xem đề án cần được xét duyệt
                            </h3>
                        </div>
                        <div class="custom-card-content">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên đề án</th>
                                        <th>Người yêu cầu</th>
                                        <th>Loại</th>
                                        <th>Email</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đăng</th>
                                        <th colspan="2">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ds as $request)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$request->Project->name}}</td>
                                            <td>{{$request->User->name}}</td>
                                            <td>{{$request->type}}</td>
                                            <td>
                                                {{$request->email}}
                                            </td>
                                            <td>{{ $request->status }}</td>
                                            <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                            @if($request->status != "Đang chờ được duyệt")
                                                <td>
                                                    <a href="{{route('admin.getApproveView',$request->id)}}" style="color:black"><i class="fas fa-pen"></i></a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.deletetApproveOrCancelView',$request->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="custom-element"><i class="fas fa-times"></i></button>                                                    
                                                    </form>
                                                </td>
                                            @else
                                                <td colspan="2">
                                                    <a href="{{route('admin.getApproveView',$request->id)}}" style="color:black"><i class="fas fa-pen"></i></a>
                                                </td>
                                            @endif
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
        </div>
    @endisset 
@endsection
@section('js')
@endsection