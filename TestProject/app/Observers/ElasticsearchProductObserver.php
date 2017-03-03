<?php namespace App\Observers;

use App\ProductMaster;
use Elasticsearch\Client;

class ElasticsearchProductObserver
{
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function created(ProductMaster $product)
    {
        $this->elasticsearch->index([
            'index' => 'acme',
            'type' => 'product',
            'id' => $product->prod_id,
            'body' => $product->toArray()
        ]);
    }

    public function updated(ProductMaster $product)
    {
        $this->elasticsearch->index([
            'index' => 'acme',
            'type' => 'product',
            'id' => $product->prod_id,
            'body' => $product->toArray()
        ]);
    }

    public function deleted(ProductMaster $product)
    {
        $this->elasticsearch->delete([
            'index' => 'acme',
            'type' => 'product',
            'id' => $product->prod_id
        ]);
    }
}