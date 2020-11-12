<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BatimentController extends AbstractController
{

    /**
     * @Route("/batiment", name="batiment")
     */
    public function index()
    {

        return $this->render('batiment/index.html.twig', [
            'controller_name' => 'BatimentController',
        ]);
    }
}
