@extends('template')

@section('content')
    <div  id="home">
        <div class="container">
            <h1 class="pt-3 pb-3">1000 films triés par genre</h1>
            <section class="d-flex main">
                <aside class="mb-3">
                    <ul>
                        <li>
                            <label>Sous-Genre</label>
                            <ul class="ml-2">
                                <li>Romantique</li>
                                <li>À suspense</li>
                                <li>D'aventure</li>
                                <li>Émouvant</li>
                            </ul>
                        </li><br>
                        <li>
                            <label>Lieu de production</label>
                            <ul class="ml-2">
                                <li>Europe</li>
                                <li>Afrique</li>
                                <li>Asie</li>
                                <li>Amérique</li>
                            </ul>
                        </li>
                    </ul>
                </aside>

                <div class="row">
                    <div class="col-md-12">
                            <div class="col-md-3">
                                <img src="{{ asset('/images/movie.png') }}" alt="" class="img-responsive">
                            </div> 
                    </div>
                </div>
            </section>
        </div>
    </div>
    
@endsection
