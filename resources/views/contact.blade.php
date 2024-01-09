@extends('layout.master')
@section('css')
@endsection
@section('content')

	<!-- Breadcrumb -->
	<div class="container">
		<div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href="{{route('getHomepage')}}" class="breadcrumb-item f1-s-3 cl9">
					Trang chủ 
				</a>
				<span class="breadcrumb-item f1-s-3 cl9">
					Liên hệ
				</span>
			</div>
			<form action="{{route('search')}}" class="searchbox" method="get">
				<div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">				
					<input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Tìm kiếm..." value="{{ isset($search) ? $search : '' }}">
					<button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
						<i class="zmdi zmdi-search"></i>
					</button>
				</div>			
			</form>
		</div>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-60">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-8 p-b-80">
					<div class="p-r-10 p-r-0-sr991">
						<div class="container p-t-4 p-b-40">
							<h2 class="f1-l-1 cl2">
								Liên hệ
							</h2>
						</div>
						@if(session('success'))
							<br>
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						<br>
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<form action="{{route('postContact')}}" method="POST">
							@csrf
							<input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="name" placeholder="Họ tên">
							<input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="email" name="email" placeholder="Email">
							<textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="msg" placeholder="Nội dung"></textarea>
							<button class="size-a-20 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-20" type="submit">Gửi</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	@endsection