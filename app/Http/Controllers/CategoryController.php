<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
	public function __construct(
		private CategoryRepository $categoryRepository
	) {}

	public function index(): Collection
	{
		return $this->categoryRepository->findAll();
	}
}