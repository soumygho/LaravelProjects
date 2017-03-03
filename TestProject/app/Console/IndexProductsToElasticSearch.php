<?php namespace App\Console;

use App\ProductMaster;
use Elasticsearch\Client;
use Illuminate\Console\Command;
class IndexArticlesToElasticsearchCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = "app:es-index";

    /**
     * {@inheritdoc}
     */
    protected $description = "Indexes all articles to elasticsearch";

    /**
     * @return void
     */
    public function fire()
    {
        $models = ProductMaster::all();
        $es = new Client;

        foreach ($models as $model)
        {
            $es->index([
                'index' => 'acme',
                'type' => 'products',
                'id' => $model->id,
                'body' => $model->toArray()
            ]);
        }
    }
}