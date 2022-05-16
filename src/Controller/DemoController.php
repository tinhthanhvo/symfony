<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    /**
     * @Route("/demo")
     */
    public function index(): Response
    {
        return $this->render('demo_api/index.html.twig', [
            'controller_name' => 'DemoController',
        ]);
    }
}
