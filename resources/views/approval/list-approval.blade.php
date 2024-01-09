@extends('approval.layout.master')
@section('css')
    <link rel="stylesheet" href="{{asset('ad/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('ad/css/responsive.css')}}">
@endsection
@section('approval')
    @isset($projects)
        @php
            $i=1;
            $ds=[];
            if(isset($results))
                $ds=$results;
            else
                $ds=$projects;
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
                                Quản lý đề án xét duyệt
                            </h3>
                        </div>
                        <div class="custom-card-content">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên đề án</th>
                                        <th>Loại đề án</th>
                                        <th>Người thực hiện</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đăng</th>
                                        <th colspan="2">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ds as $project)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$project->name}}</td>
                                            <td>{{$project->Typeproject->name}}</td>
                                            <td>
                                                {{$project->implementer}}
                                            </td>
                                            <td>{{ $project->status }}</td>
                                            <td>{{ $project->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a href="{{ route('getApprovalPost', $project->id) }}" style="color:black"><i class="fas fa-pen"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{route('deletetApproval',$project->id)}}" method="post">
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