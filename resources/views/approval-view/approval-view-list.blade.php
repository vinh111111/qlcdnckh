@extends('approval-view.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('approval-view')
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
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-m-12 col-sm-12">
                    <div class="custom-card">
                        <div class="custom-card-header">
                            <h3>
                                Danh sách yêu cầu xem đề án
                            </h3>
                        </div>
                        <div class="custom-card-content">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên đề án</th>
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
                                            <td>
                                                <form action="{{ route('deleteApprovalView',$request->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                   <button type="submit" class="custom-element"><i class="fas fa-times"></i></button>                                                    
                                                </form>
                                            </td>
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