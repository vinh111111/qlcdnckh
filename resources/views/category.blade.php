@extends('layout.master')
@section('css')
@endsection
@section('content')

	<!-- Breadcrumb -->
	<div class="container">
		<div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 m-tb-6">
				<a href="{{route('getHomepage')}}" class="breadcrumb-item f1-s-3 cl9">
					Trang chủ 
				</a>
				@if(isset($search))
					<span class="breadcrumb-item f1-s-3 cl9">
						Tìm kiếm
					</span>
					<a class="breadcrumb-item f1-s-3 cl9">
						{{$search}}
					</a>
				@else
					<span class="breadcrumb-item f1-s-3 cl9">
						Danh mục
					</span>
					@isset($typeproject)
						<a href="{{route('getTypepage',$typeproject[0]->id)}}" class="breadcrumb-item f1-s-3 cl9">
							{{$typeproject[0]->name}}
						</a>
					@endisset
				@endif
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

	<!-- Post -->
	<section class="bg0 p-b-55">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 p-b-80">
					<div class="p-r-10 p-r-0-sr991">
						<div class="m-t--40 p-b-40">
							@isset($projects)
								@php
									$ds=[];
									if(isset($results))
										$ds=$results;
									else
										$ds=$projects;
								@endphp
								@foreach($ds as $project)
									<div class="flex-wr-sb-s p-t-40 p-b-15 how-bor2">
										<a href="{{route('getProjectdetail',$project->id)}}" class="size-w-8 wrap-pic-w hov1 trans-03 w-full-sr575 m-b-25">
											<img src="{{ asset('./theme/image/project/'.$project->image) }}" height="200" alt="IMG">
										</a>

										<div class="size-w-9 w-full-sr575 m-b-25">
											<h5 class="p-b-12">
												<a href="{{route('getProjectdetail',$project->id)}}" class="f1-l-1 cl2 hov-cl10 trans-03 respon2">
													{{$project->name}}
												</a>
											</h5>

											<div class="cl8 p-b-18">
												<a class="f1-s-4 cl8 hov-cl10 trans-03">
													Người đăng: {{$project->User->name}}
												</a>

												<span class="f1-s-3 m-rl-3">
													-
												</span>

												<span class="f1-s-3">
													{{ $project->created_at->format('Y-m-d') }}
												</span>
											</div>

											<div class="container-1">
												<p class="my-line f1-s-1 cl6 p-b-24">
													{{$project->summary}}
												</p>
											</div>


											<a href="{{route('getProjectdetail',$project->id)}}" class="f1-s-1 cl9 hov-cl10 trans-03">
												Đọc thêm
												<i class="m-l-2 fa fa-long-arrow-alt-right"></i>
											</a>
										</div>
									</div>
								@endforeach
							@endisset
						</div>			
						@if ($ds && $ds instanceof \Illuminate\Pagination\LengthAwarePaginator && $ds->total() > 0)
							<div class="flex-wr-c-c m-rl--7 p-t-15 custom-pagination">
								@php
									$start = max(1, $ds->currentPage() - 2);
									$end = min($ds->lastPage(), $ds->currentPage() + 2);
								@endphp

								@if ($start > 1)
									<a href="{{ $ds->url(1) }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7">1</a>
									@if ($start > 2)
										<span>...</span>
									@endif
								@endif

								@for ($i = $start; $i <= $end; $i++)
									<a href="{{ $ds->url($i) }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 {{ ($i == $ds->currentPage()) ? 'pagi-active' : '' }}">{{ $i }}</a>
								@endfor

								@if ($end < $ds->lastPage())
									@if ($end < $ds->lastPage() - 1)
										<span>...</span>
									@endif
									<a href="{{ $ds->url($ds->lastPage()) }}{{ request()->has('search') ? '&search=' . request()->input('search') : '' }}" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7">{{ $ds->lastPage() }}</a>
								@endif
							</div>
						@endif
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	@endsection