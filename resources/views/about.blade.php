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
					Về chúng tôi
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

	<!-- Page heading -->
	<div class="container p-t-4 p-b-35">
		<h2 class="f1-l-1 cl2">
			About Us
		</h2>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-110">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
						<p class="f1-s-11 cl6 p-b-25">
							Curabitur volutpat bibendum molestie. Vestibulum ornare gravida semper. Aliquam a dui suscipit, fringilla metus id, maximus leo. Vivamus sapien arcu, mollis eu pharetra vitae, condimentum in orci. Integer eu sodales dolor. Maecenas elementum arcu eu convallis rhoncus. Donec tortor sapien, euismod a faucibus eget, porttitor quis libero. 
						</p>

						<p class="f1-s-11 cl6 p-b-25">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sit amet est vel orci luctus sollicitudin. Duis eleifend vestibulum justo, varius semper lacus condimentum dictum. Donec pulvinar a magna ut malesuada. In posuere felis diam, vel sodales metus accumsan in. Duis viverra dui eu pharetra pellentesque. Donec a eros leo. Quisque sed ligula vitae lorem efficitur faucibus. Praesent sit amet imperdiet ante. Nulla id tellus auctor, dictum libero a, malesuada nisi. Nulla in porta nibh, id vestibulum ipsum. Praesent dapibus tempus erat quis aliquet. Donec ac purus id sapien condimentum feugiat.
						</p>

						<p class="f1-s-11 cl6 p-b-25">
							Praesent vel mi bibendum, finibus leo ac, condimentum arcu. Pellentesque sem ex, tristique sit amet suscipit in, mattis imperdiet enim. Integer tempus justo nec velit fringilla, eget eleifend neque blandit. Sed tempor magna sed congue auctor. Mauris eu turpis eget tortor ultricies elementum. Phasellus vel placerat orci, a venenatis justo. Phasellus faucibus venenatis nisl vitae vestibulum. Praesent id nibh arcu. Vivamus sagittis accumsan felis, quis vulputate
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	@endsection