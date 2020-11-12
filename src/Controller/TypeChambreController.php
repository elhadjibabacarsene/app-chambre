<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeChambreController extends AbstractController
{
    /**
     * @Route("/type/chambre", name="type_chambre")
     */
    public function index()
    {
        return $this->render('type_chambre/index.html.twig', [
            'controller_name' => 'TypeChambreController',
        ]);
    }
}
