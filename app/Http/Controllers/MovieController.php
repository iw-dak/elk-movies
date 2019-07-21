<?php

namespace App\Http\Controllers;

use App\Type;
use App\Actor;
use App\Movie;

use Illuminate\Http\Request;

use App\Movies\MoviesRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;

class MovieController extends Controller
{
    public function search(Request $request, MoviesRepository $repository)
    {
        $query = $request->get('query');

        if ($request->isMethod('get') || ($request->isMethod('post') && $query == ""))
        {
            $instance = new Movie;
            $movies = $repository->search("", $instance);
        }
        if($request->ajax())
        {
      
            $query = $request->get('query');
            $movie = new Movie;
            $movies = $repository->search((string) $query, $movie);
            $actor = new Actor;
            $actors = $repository->search((string) $query, $actor);
            
            // if some actors fit the search, get the movies they've played in
            if(count($actors))
            {
                $actorMovies =  $this->getRelatedMovies($actors, "actor");
                // add actor's movies to other movies
                $movies = $movies->merge($actorMovies);
            }
            
            $html = View::make('pages._partials.main-movies', ['movies' => $movies, 'count' => count($movies), 'query' => $query])->render();
            return Response::json(['html' => $html]);
        }
       
        return view('pages.home', ['movies' => $movies, 'title' => 'Quel film recherchez-vous ?']);
    }

    public function autoCompletion(Request $request, MoviesRepository $repository)
    {
        $query = $request->get('query');
        $movie = new Movie;
        $movies = $repository->search((string) $query, $movie);
        $actor = new Actor;
        $actors = $repository->search((string) $query, $actor);
        
        // if some actors fit the search, get the movies they've played in
        if(count($actors))
        {
            $actorMovies =  $this->getRelatedMovies($actors, "actor");
            // add actor's movies to other movies
            $movies = $movies->merge($actorMovies);
        }

        return json_encode($movies);
    }
    protected function getRelatedMovies($instance, $type)
    {
        $movies = [];
        if($type == "actor")
        {
            foreach($instance as $actor)
            {
                foreach($actor->movies as $movie)
                {
                    array_push($movies,$movie);
                }
            }
        }
        elseif($type == "type")
        {
            foreach($instance as $type)
            {
                $data = Movie::where('type_id',$type->id)->get();
                // echo $type->id;die();
                foreach($data as $movie)
                {
                    array_push($movies,$movie);
                }
            }
        }
        // return Movie::hydrate($movies);
        return $movies;
    }

    protected function fillPivot()
    {
        $movies = Movie::all();
        foreach($movies as $movie)
        {
            $movie->actors()->attach(rand(1,100));
        }
    }

    public function db(Request $request)
    {
        // $test = Movie::where('type_id',5)->get();
        $test = Actor::find(20);
        echo "<pre>";
        var_dump($test->pivot);
        echo "</pre>";
    }

    public function searchByType(Request $request,  MoviesRepository $repository)
    {
        $query = $request->route('type');
        $type = new Type;
        $types = $repository->search((string) $query, $type);
        
        if(count($types))
        {
            $typeId = $types[0]->id;
            $typeLabel = $types[0]->label;
            $movie = new Movie;
            $movies = $repository->search((string) $typeId, $movie);
            if($typeLabel == "sci-fi")
                $typeLabel = "Science Fiction";
            elseif($typeLabel == "Comedie")
                $typeLabel = "Comédie";
            return view('pages.home', ['movies' => $movies, 'count' => count($movies), 'type' => $typeLabel]);
        }
      
    }

    public function searchByCountry(Request $request,  MoviesRepository $repository)
    {
        $query = $request->route('query');
        $movies = $repository->search($query, "country");
        switch($query)
        {
            case 'usa':
                $query = "États Unis";
                break;
            case 'india':
                $query = "Inde";
                break;
            case 'spain':
                $query = "Espagne";
                break;
            case 'france':
                $query = "France";
                break;
        }
        return view('pages.home', ['movies' => $movies, 'count' => count($movies), 'country' => $query]);
    }
    public function searchBest(Request $request,  MoviesRepository $repository)
    {
        $query = 4;
        $movies = $repository->search($query, "best");
        return view('pages.home', ['movies' => $movies, 'title' => 'Notre top 5 des films les mieux notés dernièrement']);
    }
}
