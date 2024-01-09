@extends('layout.master')
@section('css')
@endsection
@section('content')
    <div class="container">
		<div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href="{{route('getHomepage')}}" class="breadcrumb-item f1-s-3 cl9">
					Trang chủ 
				</a>
				<span class="breadcrumb-item f1-s-3 cl9">
					Đăng nhập
				</span>
			</div>
		</div>
	</div>
    <div class="container">
        <div class="row justify-content-center">
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="login">
                    <div class="login-page">
                        <h2>Đăng nhập</h2>
                        <form action="{{route('getLogin')}}" method="post">
                            @csrf
                            <div class="login-container">                                
                                <div>
                                    <label for="email"></label>
                                    <input type="text" class="form-control" id="username" name="email" placeholder="email" required>
                                </div>
                                
                                <div>
                                    <label for="password"></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="mật khẩu" required>
                                </div>

                                <button type="submit">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection