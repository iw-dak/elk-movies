@extends('template')

@section('content')
    <div id="home">
        <div class="container-large">
          <h1 class="pt-5 pb-3">Vous souhaitez consulter les films de quelle plateforme ?</h1>
        <section class="d-flex main">
            <div class="row mx-auto">
                <div class="col-md-7">
                    <a class="btn btn-outline-primary" href="{{route('movies.filtered','prime')}}">Prime video</a>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-danger" href="{{route('movies.filtered','netflix')}}">Netflix</a>
                </div>
            </div>
        </section> 
        <section class="d-flex">
            <div class="row mx-auto">
                <div class="col-md-4">
                    <img src="{{ asset('/images/welcome.gif') }}" alt="" class="thumb">
                </div>
            </div> 
        </section>

        </div>
    </div>
@endsection
