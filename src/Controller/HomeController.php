<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $path = $this->get('kernel')->getProjectDir();
        $file = file_get_contents($path . '/public/students.json');
        $contents = json_decode($file, true);

        return $this->render('home/index.html.twig', [
            'projects' => $contents
        ]);
    }
}
