@extends('template')

@section('content')
  <div class="container-large">
    @include('pages._partials.main-movies', ['movies' => $movies])
  </div>
@endsection
