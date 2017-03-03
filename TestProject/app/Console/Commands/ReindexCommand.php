<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ProductMaster;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   protected $name = "search:reindex";
    protected $description = "Indexes all articles to elasticsearch";
    private $search;

    

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $search)
    {
        parent::__construct();
		$this->search = $search;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->info('Indexing all articles. Might take a while...');
		$models = ProductMaster::all();
		$search = ClientBuilder::create()->build();
        foreach ($models as $product)
        {
			$productsArray =  array();
			   $productsArray["product"] = $product;
			   $productsArray["category"]=$product->category();
			   $productsArray["subcategory"]=$product->subcategory();
			   $productsArray["flipkartproduct"] = $product->flipkartProduct();
			print_r($product);
            $search->index([
                'index' => 'acme',
                'type' => 'products',
                'id' => $product->prod_id,
                'body' => $productsArray
            ]);
        

            // PHPUnit-style feedback
            $this->output->write('.');
        }

        $this->info("\nDone!");
    }
}
