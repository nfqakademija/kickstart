<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Asset\Packages;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index(Packages $assetsManager)
    {
        $path = $this->get('kernel')->getProjectDir();
        $file = file_get_contents($path . '/public/students.json');
        $projects = json_decode($file, true);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'projects' => $projects,
        ]);
    }
}
