@extends('template')

@section('content')
		<div class="container-large">
        @include('pages._partials.main-movies',['movies' => $movies])
    </div>
		<div class="overlay"></div>
    <div  id="home">
		</div>

@endsection
