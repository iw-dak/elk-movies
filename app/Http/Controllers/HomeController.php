<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use BorderCloud\SPARQL\SparqlClient;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function showFiltered(Request $request, $platform)
    {
        // $list = $this->getListFromNeptune($platform);
        // dd($list);
        $list = [];
        $id = $platform == 'netflix' ? 'idNetflix' : 'IdAmazonPrimeVideo';
        $pr = $platform == 'netflix' ? 'P1874' : 'P8055';

        $request->session()->put('platform', $platform);

        $endpoint = "https://query.wikidata.org/sparql";
        $sc = new SparqlClient();
        $sc->setEndpointRead($endpoint);
       
        $q= 'PREFIX bd: <http://www.bigdata.com/rdf#>
            PREFIX wikibase: <http://wikiba.se/ontology#>
            PREFIX wd: <http://www.wikidata.org/entity/>
            PREFIX wdt: <http://www.wikidata.org/prop/direct/>

            PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
            PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

            SELECT DISTINCT
            (YEAR(?date) as ?year)
            ?'.$id.'
            ?label
            ?image
            WHERE {
                ?object wdt:P31 wd:Q11424 ;
                        wdt:P577 ?date ;
                        rdfs:label ?label ;
                        wdt:'.$pr.' ?'.$id.' ;
                        wdt:P18 ?image .
                FILTER (?'.$id.' NOT IN ('.implode(",",$list).'))
                FILTER (langMatches(lang(?label), "en"))
            }
            ORDER BY DESC (?date)
            LIMIT 30';

        $rows = $sc->query($q, 'rows');
        $err = $sc->getErrors();

        if ($err) {
            print_r($err);
            throw new \Exception(print_r($err, true));
        }
        // dd($rows);
        return view('pages.main-movies',['movies' => $rows, 'id' => $id, 'page' => 'filtered']);
    }

    public function showAll(Request $request, $platform)
    {
        $list = [];
        $id = $platform == 'netflix' ? 'idNetflix' : 'idPrime';
        $pr = $platform == 'netflix' ? 'P1874' : 'P8055';
    
        $endpoint = "https://query.wikidata.org/sparql";
        $sc = new SparqlClient();
        $sc->setEndpointRead($endpoint);
        $q = 'PREFIX bd: <http://www.bigdata.com/rdf#>
            PREFIX wikibase: <http://wikiba.se/ontology#>
            PREFIX wd: <http://www.wikidata.org/entity/>
            PREFIX wdt: <http://www.wikidata.org/prop/direct/>

            PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
            PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

            SELECT DISTINCT
            (YEAR(?date) as ?year)
            ?'.$id.'
            ?label
            ?image
            WHERE {
                ?object wdt:P31 wd:Q11424 ;
                        wdt:P577 ?date ;
                        rdfs:label ?label ;
                        wdt:'.$pr.' ?'.$id.' ;
                        wdt:P18 ?image .
                FILTER (langMatches(lang(?label), "en"))
            }
            ORDER BY DESC (?date)
            LIMIT 30';

        $rows = $sc->query($q, 'rows');
        $err = $sc->getErrors();

        if ($err) {
            print_r($err);
            throw new \Exception(print_r($err, true));
        }
   
        return view('pages.main-movies',['movies' => $rows, 'id' => $id, 'platform' => $platform, 'page' => 'all']);
    }
 
    public function getListFromNeptune($platform)
    {
        $id = $platform == 'netflix' ? 'idNetflix' : 'IdAmazonPrimeVideo';

        $endpoint = "https://sandbox.bordercloud.com/sparql";
        $sc = new SparqlClient();
        $sc->setEndpointRead($endpoint);
        $sc->setMethodHTTPRead("POST");

        $sc->setLogin("ESGI-WEB-2020");
        $sc->setPassword("ESGI-WEB-2020-heUq9f");

        $q = 'PREFIX dc: <http://purl.org/dc/elements/1.1/>
            PREFIX ns: <http://example.org/ns#>
            SELECT ?'.$id.'
            {
                GRAPH <https://www.esgi.fr/2019/ESGI5/IW1/projet3>
                {
                <http://maliste/vocabulary#'.$platform.'> dc:uuid ?'.$id.' .
                }
            }';

        $rows = $sc->query($q, 'rows');
        $err = $sc->getErrors();

        if ($err) {
            print_r($err);
            throw new \Exception(print_r($err, true));
        }

    
        return $rows;
    }

    public function insertMovie($platform,$id)
    {
        $endpoint = "https://sandbox.bordercloud.com/sparql";
        $sc = new SparqlClient();
        $sc->setEndpointWrite($endpoint);
        $sc->setMethodHTTPRead("POST");

        $sc->setLogin("ESGI-WEB-2020");
        $sc->setPassword("ESGI-WEB-2020-heUq9f");

        $q = 'PREFIX dc: <http://purl.org/dc/elements/1.1/>
        PREFIX ns: <http://example.org/ns#>
        INSERT DATA
         { 
            GRAPH <https://www.esgi.fr/2019/ESGI5/IW1/projet3>
            {
                <http://maliste/vocabulary#'.$platform.'> dc:uuid "'.$id.'" .
            }
        }';
        
        $rows = $sc->queryUpdate($q, 'rows');
        $err = $sc->getErrors();

        if ($err) {
            print_r($err);
            throw new \Exception(print_r($err, true));
        }

        return redirect()->route('movies.all',["platform" => $platform]);
    }

    public function showDetails($platform, $movie_id)
    {
        $id = $platform == 'netflix' ? 'idNetflix' : 'idPrime';
        $pr = $platform == 'netflix' ? 'P1874' : 'P8055';

        $endpoint = "https://sandbox.bordercloud.com/sparql";
        $sc = new SparqlClient();
        $sc->setEndpointWrite($endpoint);
        $sc->setMethodHTTPRead("POST");

        $sc->setLogin("ESGI-WEB-2020");
        $sc->setPassword("ESGI-WEB-2020-heUq9f");

        $q = '  PREFIX bd: <http://www.bigdata.com/rdf#>
                PREFIX wikibase: <http://wikiba.se/ontology#>
                PREFIX wd: <http://www.wikidata.org/entity/>
                PREFIX wdt: <http://www.wikidata.org/prop/direct/>

                PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
                PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

                SELECT DISTINCT
                (YEAR(?date) as ?year)
                ?idNetflix
                ?label
                ?image
                WHERE {
                    ?object wdt:P31 wd:Q11424 ;
                            wdt:P577 ?date ;
                            rdfs:label ?label ;
                            wdt:P1874 ?idNetflix ;
                            wdt:P18 ?image .
                    FILTER (?idNetflix = "80175798")
                    FILTER (langMatches(lang(?label), "en"))
                }
                ORDER BY DESC (?date)
                LIMIT 1';
            // dd($q);
        $rows = $sc->queryUpdate($q, 'rows');
        $err = $sc->getErrors();

        if ($err) {
            print_r($err);
            throw new \Exception(print_r($err, true));
        }
        dd($rows);
       return view();
    }
    // public function read()
    // {
    //     $endpoint = "https://sandbox.bordercloud.com/sparql";
    //     $sc = new SparqlClient();
    //     $sc->setEndpointRead($endpoint);
    //     $sc->setMethodHTTPRead("POST");

    //     $sc->setLogin("ESGI-WEB-2020");
    //     $sc->setPassword("ESGI-WEB-2020-heUq9f");

    //     $q = 'SELECT DISTINCT *
    //     WHERE {
    //       GRAPH <https://www.esgi.fr/2019/ESGI5/IW1/projet3> {
    //         ?s ?p ?v
    //       }
    //     }
    //     LIMIT 10';

    //     $rows = $sc->query($q, 'rows');
    //     $err = $sc->getErrors();

    //     if ($err) {
    //         print_r($err);
    //         throw new \Exception(print_r($err, true));
    //     }

    //     return $rows;
    // }

    // public function write()
    // {
    //     $endpoint = "https://sandbox.bordercloud.com/sparql";
    //     $sc = new SparqlClient();
    //     $sc->setEndpointWrite($endpoint);
    //     $sc->setMethodHTTPRead("POST");

    //     $sc->setLogin("ESGI-WEB-2020");
    //     $sc->setPassword("ESGI-WEB-2020-heUq9f");

    //     $q = 'PREFIX dc: <http://purl.org/dc/elements/1.1/>
    //     PREFIX ns: <http://example.org/ns#>
    //     INSERT DATA
    //     {
    //         GRAPH <https://www.esgi.fr/2019/ESGI5/IW1/projet3>
    //         {
    //             <http://example/book1>  ns:student "Philippe3" .
    //         }
    //     }';

    //     $rows = $sc->queryUpdate($q, 'rows');
    //     $err = $sc->getErrors();

    //     if ($err) {
    //         print_r($err);
    //         throw new \Exception(print_r($err, true));
    //     }

    //     dd($rows);
    // }
}
