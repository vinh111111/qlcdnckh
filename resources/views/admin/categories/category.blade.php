@extends('admin.categories.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('content1')
   @isset($typeprojects)
        @php
            $i=1;
            $ds=[];
            if(isset($results))
                $ds=$results;
            else
                $ds=$typeprojects;
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
                                Quản lý danh mục
                            </h3>
                            <a href="{{route('admin.getCategoryAdd')}}"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="custom-card-content">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên danh mục</th>
                                        <th colspan="2">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ds as $typeproject)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$typeproject->name}}</td>
                                            <td>
                                                <a href="{{ route('admin.getCategoryEdit', $typeproject->id) }}" style="color:black"><i class="fas fa-pen"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{route('admin.deletetCategory',$typeproject->id)}}" method="post">
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