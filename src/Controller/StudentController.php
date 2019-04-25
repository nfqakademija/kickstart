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

//        var_dump($request->query->get('project'));

        return $this->render('student/index.html.twig', [
            'name' => $request->query->get('name'),
            'project' => $request->query->get('project'),
        ]);
    }

}
