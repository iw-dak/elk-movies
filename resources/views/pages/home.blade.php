@extends('template')

@section('content')

    <div class="overlay"></div>
      <div class="container-large">
        @include('pages._partials.main-movies', ['movies' => $movies])
      </div>
    <div id="home"></div>
		
@endsection
