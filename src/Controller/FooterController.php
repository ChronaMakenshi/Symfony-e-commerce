<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FooterController extends AbstractController
{
    #[Route('/footer', name: 'app_footer')]
    public function footer(SousCategoriesRepository $sousCategoriesRepository, ProductsRepository $productsRepository): Response
    {
        return $this->render('_partials\_footer.html.twig',[
        'souscategory' => $sousCategoriesRepository->findBy([], ['souscategoriesorders'=>'asc']),
        'products' => $productsRepository->findBy([], ['created_at'=>'asc'])
    ]); 
    }
}
