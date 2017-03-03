<?php namespace App\Products;

use Illuminate\Support\Collection;

interface ProductsRepository
{
    /**
     * @param string $query = ""
     * @return Collection
     */
    public function search($query = "");
	/**
     * @return Collection
     */
    public function all();
}