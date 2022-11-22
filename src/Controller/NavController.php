<?php

namespace App\Controller;

use App\Repository\ImagesRepository;
use App\Repository\ProductsRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavController extends AbstractController
{
    #[Route('/nav', name: 'app_nav')]
    public function footer(SousCategoriesRepository $sousCategoriesRepository, ProductsRepository $productsRepository, ImagesRepository $imagesRepository): Response
    {
        return $this->render('_partials\_nav.html.twig',[
        'souscategory' => $sousCategoriesRepository->findBy([], ['souscategoriesorders'=>'desc']),
        'products' => $productsRepository->findBy([]),
        'images' => $productsRepository->findBy([])
    ]);
    }
}