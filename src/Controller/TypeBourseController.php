<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeBourseController extends AbstractController
{
    /**
     * @Route("/type/bourse", name="type_bourse")
     */
    public function index()
    {
        return $this->render('type_bourse/index.html.twig', [
            'controller_name' => 'TypeBourseController',
        ]);
    }
}
