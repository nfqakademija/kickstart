<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $json = json_decode(file_get_contents('https://nfq190418.realus.website/students.json'), true);

        return $this->render('home/index.html.twig', [
            'data' => $json
        ]);
    }

}

