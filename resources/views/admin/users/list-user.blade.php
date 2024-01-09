@extends('admin.users.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('content')
   @isset($users)
        @php
            $i=1;
            $ds=[];
            if(isset($results))
                $ds=$results;
            else
                $ds=$users;
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
                                Quản lý người dùng
                            </h3>
                            <a href="{{route('admin.getAddUser')}}"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="custom-card-content">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên người dùng</th>
                                        <th>Địa chỉ email</th>
                                        <th>Số điện thoại</th>
                                        <th colspan="2">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ds as $user)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>
                                                <a href="{{ route('admin.getUser', $user->id) }}" style="color:black"><i class="fas fa-pen"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{route('admin.deletetUser',$user->id)}}" method="post">
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