<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\SousCategories;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/categories', name: 'app_categories_')]

class CategoriesController extends AbstractController
{
    #[Route('/fullcategorie', name: 'index')]
    public function index(CategoriesRepository $categoriesRepository, SousCategoriesRepository $sousCategoriesRepository): Response
    {
        //On va chercher la liste des produits de la catégorie
        return $this->render('categories/index.html.twig',[ 'categories' => $categoriesRepository->findBy([], ['categoryOrder'=>'desc']),
        'souscategory' => $sousCategoriesRepository->findBy([], ['souscategoriesorders'=>'asc']),
    ]);
    }

    #[Route('/{slug}', name: 'list')]
    public function list(SousCategories $souscategory, ProductsRepository $productsRepository, Request $request ): Response
    {
        //On ve chercher le numéro de page dans l'url
        $page = $request->query->getInt('page', 1);

        //On va chercher la liste des produits de la catégorie
        $products = $productsRepository->findProductsPaginated($page, $souscategory->getSlug(), 2);
    
        return $this->render('categories/list.html.twig',compact('souscategory', 'products') );
        // Syntaxe alternative
        // return $this->render('categories/list.html.twig', [
        //     'category' => $category,
        //     'products' => $products
        // ]);
    }
}
