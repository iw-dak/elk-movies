<?php

namespace App\Http\Controllers;

use App\Type;
use App\Actor;
use App\Movie;

use Illuminate\Http\Request;
use App\Movies\MoviesRepository;
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
        if(($request->isMethod('post')))
        {
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
                // foreach($movies as $m)
                // {
                //     echo '<pre>';
                //     print_r($m->name);
                //     echo '</pre>';
                // }die();
            }
        }
        return view('pages.home', ['movies' => $movies]);
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
        // $movies = Movie::paginate(15);
        // $response = [
        //     'pagination' => [
        //         'total' => $movies->total(),
        //         'per_page' => $movies->perPage(),
        //         'current_page' => $movies->currentPage(),
        //         'last_page' => $movies->lastPage(),
        //         'from' => $movies->firstItem(),
        //         'to' => $movies->lastItem()
        //     ],
        //     'data' => $movies
        // ];
       
    }

    public function searchByType(Request $request,  MoviesRepository $repository)
    {
        $query = $request->route('type');
        $type = new Type;
        $types = $repository->search((string) $query, $type);
        $typesMovies = count($types) ? $this->getRelatedMovies($types, "type") : $types;

        return view('pages.home', ['movies' => $typesMovies]);
    }

    public function searchByCountry(Request $request,  MoviesRepository $repository)
    {
        $query = $request->route('query');
        $movies = $repository->search($query, "country");
        return view('pages.home', ['movies' => $movies]);
    }
    public function searchBest(Request $request,  MoviesRepository $repository)
    {
        $query = 4;
        $movies = $repository->search($query, "best");
        return view('pages.home', ['movies' => $movies]);
    }
}
