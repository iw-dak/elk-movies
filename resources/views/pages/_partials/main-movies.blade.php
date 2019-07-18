
<section class="main">
	<div class="row main-movies">
		<!-- TODO: edit foreach with elk data-->
		@for($i = 0; $i < 4; $i++)
		<div class="col-md-3">
			<img src="{{ asset('/images/Ma.jpg') }}" alt="" class="img-responsive">
		</div> 
		@endfor
	</div>
</section>
