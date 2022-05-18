<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\CategoryRepository;

class CategoryController extends Controller
{
	public function __construct(
		private CategoryRepository $categoryRepository
	) {}

	public function index()
	{
		return $this->categoryRepository->findAll();
	}
}