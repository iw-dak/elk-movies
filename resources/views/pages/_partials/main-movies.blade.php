@php

@endphp
<section class="main">
	<div class="row main-movies">

		@forelse ($movies as $movie)
			<div class="col-md-3 overlay-image">
				<img src="{{ $movie->poster }}" alt="" class="img-responsive">
		
				<div class="hover" data-toggle="popover" title="<h4> Synopsis du film</h4>" 
					data-content="<p>{{ $movie->summary }}</p>
					<hr>
					Noté {{ $movie->mark }}/5 par les internautes
					">
					<ul>
							<li>{{ $movie->name }} | ({{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }})</li>
								<small class="float:right;">Durée : {{ $movie->duration}}</small>
							<li> </li>
								@if(count($movie->actors))
									@foreach ($movie->actors as $actor)
										Joué notamment par :  <li class="ml-2">{{ $actor->firstname }} {{ $actor->lastname }}</li>
									@endforeach
						@endif
						</ul>
				</div>
			</div> 
		@empty
			<p style="color:white;">No articles found</p>
		@endforelse
	</div>
</section>
