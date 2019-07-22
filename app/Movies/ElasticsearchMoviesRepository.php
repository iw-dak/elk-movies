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

    public function search($query = "", $instance): Collection
    {
        $items = $this->searchOnElasticsearch($query, $instance);
        return $this->buildCollection($items, $instance);
    }

    private function searchOnElasticsearch($query, $instance): array
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
                      'label' =>  $query
                    ],
                ]
            ],
          ]); 
          // echo "<pre>";var_dump($items);echo "</pre>";die();
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
                 "sort" => [
                  [
                    "release_date" => [
                      "order" => "desc"
                    ]  
                ]              
              ]
            ],
          ]);
          return $items;
        }
        elseif($instance == "date")
        {
          if($query == "2019")
          {
              $to = "2019-12-31";
              $from = "2019-01-01";
          }            
          elseif($query == "2018")
          {
              $to = "2018-12-31";
              $from = "2018-01-01";
          }            
          elseif($query == "2017")
          {
              $to = "2017-12-31";
              $from = "2017-01-01";
          }            
          $instance = new Movie;
          $items = $this->search->search([
          'index' => $instance->getSearchIndex(),
          'type' => $instance->getSearchType(),
          'body' => [
                "aggs" => [
                  "range" => [
                    "date_range" => [
                        "field" => "date",
                        "format" => "yyyy-MM-d",
                        "ranges" => [
                            [ "to" => $to ], 
                            ["from" => $from ]
                        ]
                    ]
                  ]
                ]
          ],
        ]);
          return $items;
        }
        elseif($instance instanceof \App\Movie)
        {
          if(gettype($query) == "string")
            $fields = ['name', 'releaser', 'country'];
          elseif(gettype($query) == "integer")
            $fields = ['type_id'];
        }
        elseif($instance instanceof \App\Actor)
          $fields = ['firstname', 'lastname'];
       
        
        $items = $this->search->search([
          'index' => $instance->getSearchIndex(),
          'type' => $instance->getSearchType(),
           'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => $fields,
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
          {
            return Type::hydrate($sources);
          }
          else
            return Movie::hydrate($sources); 
    }
}
