<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InitialController extends AbstractController
{
    /**
     * @Route("/", name="initial")
     */
    public function index()
    {
        return $this->render('initial/index.html.twig', [
            'controller_name' => 'InitialController',
        ]);
    }
}
