<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Product;

class ProductRepository
{
	public const PRODUCTS_PER_PAGE = 20;

	public function findBy(int $page, array $filter = []): array
	{
		$query = Product::query();

		if (array_key_exists('categoryId', $filter)) {
			$query->where(['category_id' => $filter['categoryId']]);
		}

		if (array_key_exists('maxPrice', $filter)) {
			$query->where('price', '<=', $filter['maxPrice']);
		}

		if (array_key_exists('minPrice', $filter)) {
			$query->where('price', '>=', $filter['minPrice']);
		}

		if (array_key_exists('available', $filter)) {
			$query->where(['available' => $filter['available']]);
		}

		$count = $query->count();
		$items = $query->forPage($page, self::PRODUCTS_PER_PAGE)->get();
		return ['countPage' => ceil($count / self::PRODUCTS_PER_PAGE), 'products' => $items, 'currentPage' => $page];
	}

	public function find(int $id): Product
	{
		return Product::find($id);
	}

	public function add(Product $product): void
	{
		$product->saveOrFail();
	}

	public function remove(Product $product): void
	{
		$product->deleteOrFail();
	}

	public function update(Product $product): void
	{
		$product->updateOrFail();
	}
}