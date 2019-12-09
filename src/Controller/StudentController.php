<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(Request $request)
    {
        $data = file_get_contents('https://hw1.nfq2019.online/students.json');
        $students=json_decode($data, true);
        $name = $request->get('student');

        return $this->render('student/index.html.twig', [
            'HomeController' => $name,
        ]);

    }
}
