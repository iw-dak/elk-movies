@extends('template')

@section('content')
    <div id="home">
        <div id="overlay">
            <div class="container-large">
                <h1 class="pt-5 pb-3">{{ $movie["label"] }}</h1>
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
                    <div class="col-12 row no-gutters align-self-center div-movies">
                        <span class="col-6">
                            <a href="{{ route('movie.see',[$platform,$movie[$id]]) }}">
                                <img src="{{ $movie["image"] }}" alt="" class="img-responsive">
                            </a>
                        </span>
                        <span class="col-6">
                            <a href="{{ route('movie.insert',['platform' => $platform,'id' => $movie[$id]]) }}">
                                <img src="{{ asset('/images/thumb.svg') }}" alt="">
                            </a> 
                            <p class="justify-content-center d-flex white">Remove from your films</p>
                        </span>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
