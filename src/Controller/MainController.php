<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CategoriesRepository $categoriesRepository, SousCategoriesRepository $sousCategoriesRepository, ProductsRepository $productsRepository): Response
    {
        return $this->render('main/index.html.twig',[ 'categories' => $categoriesRepository->findBy([], ['categoryOrder'=>'asc']),
        'souscategory' => $sousCategoriesRepository->findBy([], ['souscategoriesorders'=>'asc']),
        'products' => $productsRepository->findBy([], ['created_at'=>'asc']),
        'product' => $productsRepository->findByRand([])
    ]);
    }
}
