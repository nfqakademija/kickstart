<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\KernelInterface;

class HomeController extends Controller
{
    public function index(KernelInterface $kernel)
    {
        $file = file_get_contents($kernel->getRootDir() . '/../public/students.json');
        $contents = json_decode($file, true);

        return $this->render('home/index.html.twig', [
            'projects' => $contents
        ]);
    }
}
