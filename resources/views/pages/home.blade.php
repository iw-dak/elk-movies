@extends('template')

@section('content')
    <div  id="home">
        <div class="container-large">
            @include('pages._partials.main-movies',['title' => '1000 films triés par genre'])


            {{-- foreach ($rows["result"]["variables"] as $variable) {
            printf("%-20.20s", $variable);
            echo '|';
        }
        echo "\n";

        foreach ($rows["result"]["rows"] as $row) {
            foreach ($rows["result"]["variables"] as $variable) {
                printf("%-20.20s", $row[$variable]);
                echo '|';
            }
            echo "\n";
        } --}}
        </div>
    </div>

@endsection
