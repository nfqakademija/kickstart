<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->render('student/index.html.twig', [
            'name' => $request->query->get('name'),
            'project' => $request->query->get('project'),
        ]);
    }

    /**
     * @Route("/student-json", name="student-json")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getStudentJson()
    {

        return $this->render('student/json.html.twig', [
            'data' => file_get_contents('students.json')
        ]);
    }

}
