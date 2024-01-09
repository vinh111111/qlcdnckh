@extends('layout.master')
@section('css')
@endsection
@section('content')
	@isset($project)
		<div class="container">
			<div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
				<div class="f2-s-1 p-r-30 m-tb-6">
					<a href="{{route('getHomepage')}}" class="breadcrumb-item f1-s-3 cl9">
						Trang chủ
					</a>

					<a href="{{route('getTypepage',$project->id_type)}}" class="breadcrumb-item f1-s-3 cl9">
						{{$project->Typeproject->name}} 
					</a>

					<span class="breadcrumb-item f1-s-3 cl9">
						{{$project->name}}
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
		<section class="bg0 p-b-140 p-t-10">
			<div class="container">
				@if(session('success'))
					<br>
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
					<br>
				@endif
				<div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
					<div class="row justify-content-center">
						<div class="col-12 p-b-30">
							<div class="p-r-10 p-r-0-sr991">
								<div class="p-b-70">
									<h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
										{{$project->name}}
									</h3>
									
									<div class="flex-wr-s-s p-b-40">
										<span class="f1-s-3 cl8 m-r-15">
											<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
												Người đăng: {{$project->User->name}}
											</a>

											<span class="m-rl-3">-</span>

											<span>
												{{ $project->created_at->format('Y-m-d') }}
											</span>
										</span>
									</div>

									<div class="wrap-pic-max-w p-b-30">
										<img src="{{asset('./theme/image/project/'.$project->image)}}" width="1200px" height="700px" alt="IMG">
									</div>

									<p class="f1-s-11 cl6 p-b-25 preserve-text-summary ">
										{{$project->summary}}
									</p>

									<!-- Tag -->
									<div class="flex-s-s p-t-12 p-b-15">
										<span class="f1-s-12 cl5 m-r-8">
											Người thực hiện: {{$project->implementer}} 
										</span>
									</div>
									@if(Auth::check())
										@if($project->report_link || $project->application_link || $project->product_link)
											<div class="flex-s-s">
												<span class="f1-s-12 cl5 p-t-1 m-r-15">
													Đường dẫn:
												</span>
												<div class="flex-wr-s-s size-w-0">
													@if($project->application_link)
														<a href="{{ route('requestEmail',['projectLinkType' => 'application_link','projectId' => $project->id ]) }}" class="dis-block f1-s-13 cl0 bg-google borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
															Ứng dụng
														</a>
													@endif
													@if($project->report_link )
														<a href="{{ route('requestEmail',['projectLinkType' => 'report_link','projectId' => $project->id ]) }}" class="dis-block f1-s-13 cl0 bg-pinterest borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
															Báo cáo
														</a>
													@endif
													@if($project->product_link )
														<a href="{{ route('requestEmail',['projectLinkType' => 'product_link','projectId' => $project->id ]) }}" class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
															Sản phẩm
														</a>
													@endif
												</div>
											</div>
										@endif
									@endif									
								</div>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</section>
	@endisset
@endsection