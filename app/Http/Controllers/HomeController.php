<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use BorderCloud\SPARQL\SparqlClient;

class HomeController extends Controller
{
    public function show()
    {
        $endpoint = "https://query.wikidata.org/sparql";
        $sc = new SparqlClient();
        $sc->setEndpointRead($endpoint);
        //$sc->setMethodHTTPRead("GET");
        $q = 'PREFIX bd: <http://www.bigdata.com/rdf#>
        PREFIX wikibase: <http://wikiba.se/ontology#>
        PREFIX wd: <http://www.wikidata.org/entity/>
        PREFIX wdt: <http://www.wikidata.org/prop/direct/>

        SELECT ?filmActionLabel ?filmActionDescription

        WHERE {
             ?filmAction wdt:P31 wd:Q11424 ;

            # Doc : https://www.mediawiki.org/wiki/Wikidata_query_service/User_Manual#Label_service
            # SELECT ?variableLabel ?variableAltLabel  ?variableDescription
            SERVICE wikibase:label {
                 bd:serviceParam wikibase:language "fr, en" .
            }
        }
        LIMIT 10';

        $rows = $sc->query($q, 'rows');
        $err = $sc->getErrors();

        if ($err) {
            print_r($err);
            throw new \Exception(print_r($err, true));
        }

        dd($rows);
        return view('pages.home');
    }

    public function read()
    {
        $endpoint = "https://sandbox.bordercloud.com/sparql";
        $sc = new SparqlClient();
        $sc->setEndpointRead($endpoint);
        $sc->setMethodHTTPRead("POST");

        $sc->setLogin("ESGI-WEB-2020");
        $sc->setPassword("ESGI-WEB-2020-heUq9f");

        $q = 'SELECT DISTINCT *
        WHERE {
          GRAPH <https://www.esgi.fr/2019/ESGI5/IW1/projet3> {
            ?s ?p ?v
          }
        }
        LIMIT 10';

        $rows = $sc->query($q, 'rows');
        $err = $sc->getErrors();

        if ($err) {
            print_r($err);
            throw new \Exception(print_r($err, true));
        }

        dd($rows);
    }

    public function write()
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
                <http://example/book1>  ns:student "Philippe3" .
            }
        }';

        $rows = $sc->queryUpdate($q, 'rows');
        $err = $sc->getErrors();

        if ($err) {
            print_r($err);
            throw new \Exception(print_r($err, true));
        }

        dd($rows);
    }
}
