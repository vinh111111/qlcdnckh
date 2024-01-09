@extends('layout.master')
@section('css')
@endsection
@section('content')
	<!-- Headline -->
	<div class="container">
		<div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
			<div class="f2-s-1 p-r-30 size-w-0 m-tb-6 flex-wr-s-c">
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
		
	<!-- Feature post -->
	<section class="bg0">
		<div class="container">
			<div class="row m-rl--1">
				@isset($banners)
					@foreach($banners as $slide)
					<div class="col-sm-6 col-lg-4 p-rl-1 p-b-2">
						<div class="bg-img1 size-a-12 how1 pos-relative" style="background-image: url('{{ asset('./theme/image/project/'.$slide->image) }}')">
							<a href="{{route('getProjectdetail',$slide->id)}}" class="dis-block how1-child1 trans-03"></a>
							<div class="flex-col-e-s s-full p-rl-25 p-tb-11">
								<a href="{{route('getTypepage',$slide->id_type)}}" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
									{{$slide->Typeproject->name}}
								</a>

								<h3 class="how1-child2 m-t-10">
									<a href="{{route('getProjectdetail',$slide->id)}}" class="f1-m-1 cl0 hov-cl10 trans-03">
										{{$slide->name}}
									</a>
								</h3>
							</div>
						</div>
					</div>
					@endforeach
				@endisset
			</div>
		</div>
	</section>

	<!-- Post -->
	<section class="bg0 p-t-70">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="p-b-20">
						@isset($types)
							@foreach($types as $type)
								@if($type->id === 1)
									<div class="p-b-20">
										<div class="how2 how2-cl6 flex-sb-c m-r-10 m-r-0-sr991">
											<h3 class="f1-m-2 cl6 tab01-title">
												{{$type->name}}
											</h3>
											<a href="{{route('getTypepage',$type->id)}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
												Tất cả
												<i class="fs-12 m-l-5 fa fa-caret-right"></i>
											</a>
										</div>
										<div class="row p-t-35">
											@isset($typeproject1)
												@php
													$i = 1;
													$seenIds = [];
												@endphp

												<div class="col-sm-7 p-r-25 p-r-15-sr991">
													@foreach($typeproject1 as $project1)
														@if($i === 1 && !in_array($project1->id, $seenIds))
															<!-- Item post -->    
															<div class="m-b-30">
																<a href="{{route('getProjectdetail',$project1->id)}}" class="wrap-pic-w hov1 trans-03">
																	<img src="{{ asset('./theme/image/project/'.$project1->image) }}" height="300px" alt="IMG">
																</a>

																<div class="p-t-20">
																	<h5 class="p-b-5">
																		<a href="{{route('getProjectdetail',$project1->id)}}" class="f1-m-3 cl2 hov-cl10 trans-03">
																			{{$project1->name}}
																		</a>
																	</h5>

																	<span class="cl8">
																		<a class="f1-s-4 cl8 hov-cl10 trans-03">
																			Người đăng: {{$project1->User->name}}
																		</a>

																		<span class="f1-s-3 m-rl-3">
																			-
																		</span>

																		<span class="f1-s-3">
																			{{ $project1->created_at->format('Y-m-d') }}
																		</span>
																	</span>
																</div>
															</div>

															@php
																$seenIds[] = $project1->id;
															@endphp
														@endif

														@php
															$i++;
														@endphp
													@endforeach
												</div>

												<div class="col-sm-5 p-r-25 p-r-15-sr991">
													@foreach($typeproject1 as $project1)                                        
														@if(!in_array($project1->id, $seenIds))
															<div class="flex-wr-sb-s m-b-30">
																<a href="{{route('getProjectdetail',$project1->id)}}" class="size-w-1 wrap-pic-w hov1 trans-03">
																	<img src="{{ asset('./theme/image/project/'.$project1->image) }}" height='100' alt="IMGDonec metus orci, malesuada et lectus vitae" style="width: 100%;">
																</a>
																<div class="size-w-2">
																	<h5 class="p-b-5">
																		<a href="{{route('getProjectdetail',$project1->id)}}" class="f1-s-5 cl3 hov-cl10 trans-03">
																			{{$project1->name}}
																		</a>
																	</h5>
																	<span class="cl8">
																		<a class="f1-s-6 cl8 hov-cl10 trans-03" style="overflow: hidden; text-overflow: ellipsis;">
																			Người đăng: {{$project1->User->name}}
																		</a>
																		<span class="f1-s-3 m-rl-3">
																			-
																		</span>
																		<span class="f1-s-3">
																			{{ $project1->created_at->format('Y-m-d') }}
																		</span>
																	</span>
																</div>
															</div>

															@php
																$seenIds[] = $project1->id;
															@endphp
														@endif
													@endforeach
												</div>
											@endisset
										</div>
									</div>
								@elseif($type->id ===2)
									<div class="p-b-20">
										<div class="how2 how2-cl4 flex-sb-c m-r-10 m-r-0-sr991">
											<h3 class="f1-m-2 cl4 tab01-title">
												{{$type->name}}
											</h3>
											<a href="{{route('getTypepage',$type->id)}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
												Tất cả
												<i class="fs-12 m-l-5 fa fa-caret-right"></i>
											</a>
										</div>
										<div class="row p-t-35">
											@isset($typeproject2)
												@php
													$i = 1;
													$seenIds = [];
												@endphp

												<div class="col-sm-7 p-r-25 p-r-15-sr991">
													@foreach($typeproject2 as $project2)
														@if($i === 1 && !in_array($project2->id, $seenIds))
															<!-- Item post -->    
															<div class="m-b-30">
																<a href="{{route('getProjectdetail',$project2->id)}}" class="wrap-pic-w hov1 trans-03">
																	<img src="{{ asset('./theme/image/project/'.$project2->image) }}" height="300px" alt="IMG">
																</a>

																<div class="p-t-20">
																	<h5 class="p-b-5">
																		<a href="{{route('getProjectdetail',$project2->id)}}" class="f1-m-3 cl2 hov-cl10 trans-03">
																			{{$project2->name}}
																		</a>
																	</h5>

																	<span class="cl8">
																		<a class="f1-s-4 cl8 hov-cl10 trans-03">
																			Người đăng: {{$project2->User->name}}
																		</a>

																		<span class="f1-s-3 m-rl-3">
																			-
																		</span>

																		<span class="f1-s-3">
																			{{ $project2->created_at->format('Y-m-d') }}
																		</span>
																	</span>
																</div>
															</div>

															@php
																$seenIds[] = $project2->id;
															@endphp
														@endif

														@php
															$i++;
														@endphp
													@endforeach
												</div>

												<div class="col-sm-5 p-r-25 p-r-15-sr991">
													@foreach($typeproject2 as $project2)                                        
														@if(!in_array($project2->id, $seenIds))
															<div class="flex-wr-sb-s m-b-30">
																<a href="{{route('getProjectdetail',$project2->id)}}" class="size-w-1 wrap-pic-w hov1 trans-03">
																	<img src="{{ asset('./theme/image/project/'.$project2->image) }}" height='100' alt="IMGDonec metus orci, malesuada et lectus vitae" style="width: 100%;">
																</a>
																<div class="size-w-2">
																	<h5 class="p-b-5">
																		<a href="{{route('getProjectdetail',$project2->id)}}" class="f1-s-5 cl3 hov-cl10 trans-03">
																			{{$project2->name}}
																		</a>
																	</h5>
																	<span class="cl8">
																		<a class="f1-s-6 cl8 hov-cl10 trans-03" style="overflow: hidden; text-overflow: ellipsis;">
																			Người đăng: {{$project2->User->name}}
																		</a>
																		<span class="f1-s-3 m-rl-3">
																			-
																		</span>
																		<span class="f1-s-3">
																			{{ $project2->created_at->format('Y-m-d') }}
																		</span>
																	</span>
																</div>
															</div>
															@php
																$seenIds[] = $project2->id;
															@endphp
														@endif
													@endforeach
												</div>
											@endisset
										</div>
									</div>
								@else
									<div class="p-b-20">
										<div class="how2 how2-cl1 flex-sb-c m-r-10 m-r-0-sr991">
											<h3 class="f1-m-2 cl12 tab01-title">
												{{$type->name}}
											</h3>
											<a href="{{route('getTypepage',$type->id)}}" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
												Tất cả
												<i class="fs-12 m-l-5 fa fa-caret-right"></i>
											</a>
										</div>
										<div class="row p-t-35">
											@isset($typeproject3)
												@php
													$i = 1;
													$seenIds = [];
												@endphp

												<div class="col-sm-7 p-r-25 p-r-15-sr991">
													@foreach($typeproject3 as $project3)
														@if($i === 1 && !in_array($project3->id, $seenIds))
															<!-- Item post -->    
															<div class="m-b-30">
																<a href="{{route('getProjectdetail',$project3->id)}}" class="wrap-pic-w hov1 trans-03">
																	<img src="{{ asset('./theme/image/project/'.$project3->image) }}" height="300px" alt="IMG">
																</a>

																<div class="p-t-20">
																	<h5 class="p-b-5">
																		<a href="{{route('getProjectdetail',$project3->id)}}" class="f1-m-3 cl2 hov-cl10 trans-03">
																			{{$project3->name}}
																		</a>
																	</h5>

																	<span class="cl8">
																		<a class="f1-s-4 cl8 hov-cl10 trans-03">
																			Người đăng: {{$project3->User->name}}
																		</a>

																		<span class="f1-s-3 m-rl-3">
																			-
																		</span>

																		<span class="f1-s-3">
																			{{ $project3->created_at->format('Y-m-d') }}
																		</span>
																	</span>
																</div>
															</div>

															@php
																$seenIds[] = $project3->id;
															@endphp
														@endif

														@php
															$i++;
														@endphp
													@endforeach
												</div>

												<div class="col-sm-5 p-r-25 p-r-15-sr991">
													@foreach($typeproject3 as $project3)                                        
														@if(!in_array($project3->id, $seenIds))
															<div class="flex-wr-sb-s m-b-30">
																<a href="{{route('getProjectdetail',$project3->id)}}" class="size-w-1 wrap-pic-w hov1 trans-03">
																	<img src="{{ asset('./theme/image/project/'.$project3->image) }}" height='100' alt="IMGDonec metus orci, malesuada et lectus vitae" style="width: 100%;">
																</a>
																<div class="size-w-2">
																	<h5 class="p-b-5">
																		<a href="{{route('getProjectdetail',$project3->id)}}" class="f1-s-5 cl3 hov-cl10 trans-03">
																			{{$project3->name}}
																		</a>
																	</h5>
																	<span class="cl8">
																		<a class="f1-s-6 cl8 hov-cl10 trans-03" style="overflow: hidden; text-overflow: ellipsis;">
																			Người đăng: {{$project3->User->name}}
																		</a>
																		<span class="f1-s-3 m-rl-3">
																			-
																		</span>
																		<span class="f1-s-3">
																			{{ $project3->created_at->format('Y-m-d') }}
																		</span>
																	</span>
																</div>
															</div>
															@php
																$seenIds[] = $project3->id;
															@endphp
														@endif
													@endforeach
												</div>
											@endisset
										</div>
									</div>
								@endif
							@endforeach
						@endisset
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection