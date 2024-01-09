<footer>
	<div class="bg2 p-b-50">
		<!-- p-t-40 -->
		<div class="container">
			<div class="row">
				<div class="col-lg-5 p-b-20">
					<div class="size-h-3 flex-s-c mgt">
						<div class="footer-h">
							<img class="max-s-full" src="{{asset('theme/images/icons/logoo.png')}}" alt="LOGO">
							<div class="footer-info">
								<h3 class="">TRƯỜNG CAO ĐẲNG NGHỀ ĐÀ NẴNG</h3>
								<h4 class="">DANANG VOCATIONAL TRAINING COLLEGE</h4>
							</div>
						</div>
					</div>

					<div class="info-n">
						<p class="f1-s-1 cl11 p-b-16">
						<p class="sp"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa chỉ: 99 Tô Hiến Thành, Sơn Trà, Đà Nẵng</p>
						<p class="sp"><i class="fa fa-phone-square" aria-hidden="true"></i> Điện Thoại: <a href="tel:02363942790">02363.942.790</a> –
							<a href="tel:02363940946">02363.940.946</a>
						</p>
						<p class="sp"><i style="font-size:12px;" class="fa fa-envelope" aria-hidden="true"></i> Email: <a href="mailto:danavtc@danavtc.edu.vn">danavtc@danavtc.edu.vn</a>
						</p>

						<div class="p-t-15" style="margin-top: 15px;">
							<a href="https://www.facebook.com/DANAVTC/" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
								<span class="fab fa-facebook-f"></span>
							</a>

							<a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
								<span class="fab fa-twitter"></span>
							</a>

							<a href="https://www.youtube.com/watch?v=syNCRQNQnCA" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
								<span class="fab fa-youtube"></span>
							</a>

							<a href="https://danavtc.edu.vn/" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
								<span class="fab fa-instagram"></span>
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-lg-4 p-b-20">
					<div class="size-h-3 flex-s-c">
						<h5 class="f1-m-7 cl0">
							Vị trí bản đồ
						</h5>
					</div>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4592.598088079358!2d108.2423289923222!3d16.05948409535027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142177f2ced6d8b%3A0xe282c779264f7088!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIE5naOG7gSDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1704365394568!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>

				<div class="col-sm-6 col-lg p-b-20">
					<div class="size-h-3 flex-s-c">
						<h5 class="f1-m-7 cl0">
							Danh mục
						</h5>
					</div>

					<ul class="m-t--12">
						@isset($typeproject)
						@foreach($typeproject as $type)
						<li class="how-bor1 p-rl-5 p-tb-10">
							<a href="{{route('getTypepage',$type->id)}}" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
								{{$type->name}}
							</a>
						</li>
						@endforeach
						@endisset
					</ul>
				</div>
			</div>
		</div>
	</div>


</footer>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
	<span class="symbol-btn-back-to-top">
		<span class="fas fa-angle-up"></span>
	</span>
</div>

<!-- Modal Video 01-->
<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document" data-dismiss="modal">
		<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

		<div class="wrap-video-mo-01">
			<div class="video-mo-01">
				<iframe src="https://www.youtube.com/embed/wJnBTPUQS5A?rel=0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>