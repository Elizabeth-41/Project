<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\WorkshopRepositoryInterface;

class FrontService
{
    protected $categoryRepository;
    protected $WorkshopRepository;

    public function __construct(WorkshopRepositoryInterface $WorkshopRepository,
    CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->WorkshopRepository = $WorkshopRepository;
    }

    public function getFrontPageData()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $newWorkshops = $this->WorkshopRepository->getAllNewWorkshops();

        return compact('categories', 'newWorkshops');
    }
}