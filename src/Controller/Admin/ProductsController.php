<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/produits', name: 'app_admin_products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'app_index')]
        public function index(): Response
        {
            return $this->render('admin\products\index.html.twig');
        }

        #[Route('/ajout', name: 'app_add')]
        public function add(): Response
        {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            return $this->render('admin\products\index.html.twig');
        }

        #[Route('/edition/{id}', name: 'app_edit')]

        public function edit(Products $product): Response
        {
             // On vérifie si l'utilisateur peut éditer avec le voter
            $this->denyAccessUnlessGranted('PRODUCT_EDIT', $product);
            return $this->render('admin\products\index.html.twig');
        }

        #[Route('/suppression/{id}', name: 'app_delete')]
        public function delete(Products $product): Response
        {
              // On vérifie si l'utilisateur peut supprimé avec le voter
              $this->denyAccessUnlessGranted('PRODUCT_DELETE', $product);
            return $this->render('admin\products\index.html.twig');
        }
}


