<?php namespace App\Products;

use Illuminate\Support\Collection;
use App\ProductMaster;
use Elasticsearch\Client;

class ElasticsearchArticlesRepository implements ProductsRepository
{
    private $elasticsearch;
    private $innerRepository;

    public function __construct(Client $client)
    {
        $this->elasticsearch = $client;
        //$this->innerRepository = $innerRepository;
    }

    /**
     * @param string $query = ""
     * @return Collection
     */
    public function search($query = "")
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    /**
     * @return Collection
     */
    public function all()
    {
		$products =  ProductMaster::orderBy('prod_id', 'asc')->get();
        return $products;
    }

    /**
     * @param string $query
     * @result array
     */
    private function searchOnElasticsearch($query)
    {
        $items = $this->elasticsearch->search([
            'index' => 'acme',
            'type' => 'products',
            'body' => [
                'query' => [
                    'query_string' => [
                        'query' => $query
                    ]
                ]
            ]
        ]);

        return $items;
    }

    /**
     * @param array $items the elasticsearch result
     * @return Collection of Eloquent models
     */
    private function buildCollection($items)
    {
        $result = $items['hits']['hits'];

        return Collection::make(array_map(function($r) {
            $ProductMaster = new ProductMaster();
            $ProductMaster->newInstance($r['_source'], true);
            $ProductMaster->setRawAttributes($r['_source'], true);
            return $ProductMaster;
        }, $result));
    }
}