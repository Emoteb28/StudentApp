<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $now = new DateTime();
        $footer_year = $now->format('Y-m-d H:i:s');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'footer_year' => $footer_year

        ]);
    }

    public function year()
    {
        $now = new DateTime();
        return $now->format('Y-m-d H:i:s');
    }
}
