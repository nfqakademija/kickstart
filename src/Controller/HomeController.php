<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\JsonParserController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'projects' => JsonParserController::getStudentData(),
        ]);
    }

    /**
     * @Route("/student", name="SingleStudent", methods={"GET"})
     */
    public function displaySingleStudent(Request $request)
    {
        return $this->render('home/student.html.twig', [
            'name'      => $request->get('name', ''),
            'project'   => $request->get('project', '')
        ]);
    }
}
