
<div class="title">
@isset($title)
	<h1> {{ $title }} </h1>
@endisset
@isset($query)
	<h1>Critère(s) de recherche : "{{ $query }}" ({{ $count }}) résultats trouvés.</h1>
@endisset
@isset($type)
	<h1>Films dans la catégorie "{{ $type }}" ({{ $count }})	</h1>  	
@endisset
@isset($country)
	<h1>Films triés par pays : "{{ $country }}" ({{ $count }})	</h1>
@endisset
</div>
<div class="main">
	<div class="row main-movies">
		@forelse ($movies as $movie)
			<div class="col-md-3 overlay-image">
				<img src="{{ $movie->poster }}" alt="" class="img-responsive">
		
				<div class="hover" data-toggle="popover" title="<h4> <img src='{{ asset('images/synopsis.png') }}' alt='Logo' class='mb-1'> Synopsis du film</h4>" 
					data-content="<p>{{ $movie->summary }}</p>
					<hr>
					 <img src='{{ asset('images/star.png') }}' alt='Logo' class='mb-1'>
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
			<p style="color:white;">Aucun film trouvé</p>
		@endforelse
	</div>
</div>
