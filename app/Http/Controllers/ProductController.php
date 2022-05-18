<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repository\ProductRepository;

class ProductController extends Controller
{
	public function __construct(
		private ProductRepository $productRepository
	) {}

	public function index(ProductRequest $request, int $page = 1)
	{
		return $this->productRepository->findBy($page, $request->validated());
	}
}