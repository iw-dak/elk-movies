<?php

namespace App\Movies;

use App\Type;
use App\Actor;
use App\Movie;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchMoviesRepository implements MoviesRepository
{
    private $search;
 
    public function __construct(Client $client) {
        $this->search = $client;
    }

    public function search(string $query = "", $instance): Collection
    {
        $items = $this->searchOnElasticsearch($query, $instance);
        return $this->buildCollection($items, $instance);
    }

    private function searchOnElasticsearch(string $query, $instance): array
    {

        if($query == '')
          $items = $this->search->search([
              'index' => $instance->getSearchIndex(),
                'from' => 0, 
                "size" => 10000
          ]);
        else
        {
          if($instance instanceof \App\Type)
          {
            
              $items = $this->search->search([
              'index' => $instance->getSearchIndex(),
              'type' => $instance->getSearchType(),
              'body' => [
                  'query' => [
                      'match' => [
                          'id' =>  $query
                      ],
                  ],
              ],
            ]);

            return $items;
          }
          elseif($instance == "country")
          {
      
            $column = $instance;
 
            $inst = new Movie;
            $items = $this->search->search([
              'index' => $inst->getSearchIndex(),
              'type' => $inst->getSearchType(),
              'body' => [
                  'query' => [
                      'bool' => [
                          'must' => [
                            'multi_match' => [
                              'query' => $query,
                                'fields' => [
                                  $column
                                ],
                                "operator" => "AND"
                            ]
                          ]
                      ]
                  ]
              ]
            ]);
            return $items;
          }
          elseif($instance == "best")
          {
             $instance = new Movie;
             $items = $this->search->search([
              'index' => $instance->getSearchIndex(),
              'from' => 0, 
              "size" => 5,
              'type' => $instance->getSearchType(),
              'body' => [
                  "query" => [
                    "range" => [
                        "mark" => [
                            "gte" => $query,
                            "boost" => 2.0
                        ]
                    ]
                  ],
              ],
            ]);
            return $items;
          }
          elseif($instance instanceof \App\Movie)
            $fields = ['name', 'releaser', 'country', 'release_date'];
          elseif($instance instanceof \App\Actor)
            $fields = ['firstname', 'lastname'];
      
          $items = $this->search->search([
            'index' => $instance->getSearchIndex(),
            'type' => $instance->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' =>  $fields,
                        'query' => $query,
                    ],
                ],
            ],
          ]);
        }
        return $items;
    }

    private function buildCollection(array $items, $instance): Collection
    {
        /**
         * The data comes in a structure like this:
         *
         * [
         *      'hits' => [
         *          'hits' => [
         *              [ '_source' => 1 ],
         *              [ '_source' => 2 ],
         *          ]
         *      ]
         * ]
         *
         * And we only care about the _source of the documents.
        */
          $hits = array_pluck($items['hits']['hits'], '_source') ?: [];
          
          $sources = array_map(function ($source) {
            // The hydrate method will try to decode this
            // field but ES gives us an array already.
            $source['id'] = json_encode($source['id']);
            return $source;
          }, $hits);

          // We have to convert the results array into Eloquent Models.
          if($instance instanceof \App\Actor)
            return Actor::hydrate($sources);
          elseif($instance instanceof \App\Type)
            return Type::hydrate($sources);
          else
            return Movie::hydrate($sources);
          
    }

}
