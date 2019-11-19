<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function student(Request $request)
    {
        $name = $request->query->get('name');
        $project = $request->query->get('project');
        return $this->render('student/index.html.twig', [
            'name' => $name,
            'project' => $project,
        ]);
    }
}
