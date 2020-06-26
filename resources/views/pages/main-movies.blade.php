@extends('template')

@section('content')
    <div id="home">
        <div id="overlay">
            <div class="container-large">
                <h1 class="pt-5 pb-3">Liste des films</h1>
                <section class="d-flex main">
                    {{-- <aside class="mb-3 mr-2">
                        <ul>
                            <li>
                                <label>Sous-Genre</label>
                                <ul class="ml-2">
                                    <li>Romantique</li>
                                    <li>À suspense</li>
                                    <li>D'aventure</li>
                                    <li>Émouvant</li>
                                    <li>Sombre</li>
                                    <li>Loufoque</li>
                                    <li>Violent</li>
                                </ul>
                            </li><br>
                            <li>
                                <label>Lieu</label>
                                <ul class="ml-2">
                                    <li>Europe</li>
                                    <li>Afrique</li>
                                    <li>Asie</li>
                                    <li>Amérique</li>
                                </ul>
                            </li>
                        </ul>
                    </aside> --}}
                    {{-- @if ($page == 'all')
                        
                    @endif --}}
                    <div class="row">
                        <!-- TODO: edit foreach with elk data-->
                        @foreach($movies["result"]["rows"] as $movie)
                            <div class="col-md-3 div-movies">
                                <img src="{{ $movie["image"] }}" alt="" class="img-responsive">
                                @if ($page == "all")
                                    <a href="{{ route('movie.insert',$movie[$id]) }}">
                                        <img src="{{ asset('/images/thumb.svg') }}" alt="" class="thumb">
                                    </a> 
                                @endif
                            <p class="img__description">{{ $movie["label"] }}</p>
                            </div> 
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
