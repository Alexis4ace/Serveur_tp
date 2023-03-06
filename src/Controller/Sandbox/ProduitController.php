<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/sandbox/produit', name: 'sandbox_produit')]
class ProduitController extends AbstractController
{
    #[Route(
        '/',
        
        name: '_accueil',
    )]
    public function redirect1Action(): Response
    {

        return $this->redirectToRoute('sandbox_route_redirect2');
    }

   

}
