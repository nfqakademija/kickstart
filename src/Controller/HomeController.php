<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $projects = json_decode(file_get_contents('https://nfq190418.realus.website/students.json'), true);

        print_r($projects);

        return $this->render('home/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
