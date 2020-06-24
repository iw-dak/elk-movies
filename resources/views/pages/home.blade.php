@extends('template')

@section('content')
    <div  id="home">
        <div class="container-large">
            @include('pages._partials.main-movies',['title' => '1000 films triés par genre'])
        </div>
    </div>
    
@endsection
