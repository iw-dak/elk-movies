<?php

namespace App\Movies;

use App\Movie;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElkMoviesByFieldRepository implements MoviesRepository
{
    private $search;

    public function __construct(Client $client) {
        $this->search = $client;
    }

    public function search(string $query = "", $instance): Collection
    {
        $items = $this->searchOnElasticsearch($query, $instance);
        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query, $column): array
    {
      $items = $this->search->search([
        'index' => $instance->getSearchIndex(),
        'type' => $instance->getSearchType(),
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

    private function buildCollection(array $items, $instance): Collection
    {

          $hits = array_pluck($items['hits']['hits'], '_source') ?: [];
          
          $sources = array_map(function ($source) {
            // The hydrate method will try to decode this
            // field but ES gives us an array already.
            $source['id'] = json_encode($source['id']);
            return $source;
          }, $hits);

          // We have to convert the results array into Eloquent Models.
          return Movie::hydrate($sources);
        
    }

}
