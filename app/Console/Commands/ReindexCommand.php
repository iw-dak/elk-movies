<?php

namespace App\Console\Commands;

// Models to index
use App\Type;
use App\Actor;
use App\Movie;
use App\Review;

use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    // protected $name = "search:reindex";
    // name of the command and required argument to pass
    protected $signature = 'search:reindex {model}';
    protected $description = "Indexes all articles to elasticsearch";
    private $search;

    public function __construct(Client $search)
    {
        parent::__construct();

        $this->search = $search;
    }

    public function handle()
    {
        $this->info('Indexing all data from Model. Might take a while...');
       
        $model = $this->argument('model');
        switch($model)
        {
            case 'Movie':
                $modelData = Movie::cursor();
                break;
            case 'Type':
                $modelData = Type::cursor();
                break;
            case 'Actor':
                $modelData = Actor::cursor();
                break;
        }

        foreach ($modelData as $model)
        {
            $this->search->index([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'id' => $model->id,
                'body' => $model->toSearchArray(),
            ]);

            // PHPUnit-style feedback
            $this->output->write('.');
        }

        $this->info("Done, Yata!");
    }
}
