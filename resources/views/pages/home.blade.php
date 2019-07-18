@extends('template')

@section('content')
		<div class="container-large">
        @include('pages._partials.main-movies',['title' => '1000 films triés par genre'])
    </div>
		<div class="overlay"></div>
    <div  id="home">
		</div>

@endsection
