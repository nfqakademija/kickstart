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
       $data = file_get_contents('https://hw1.nfq2019.online/students.json');
       $process=json_decode($data, true);
       return $this->render('home/index.html.twig', [
           'process' => $process,
       ]);
    }
}
