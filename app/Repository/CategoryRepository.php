<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
	public function findAll(): Collection
	{
		return Category::all();
	}
}