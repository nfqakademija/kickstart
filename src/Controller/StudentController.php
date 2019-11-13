<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student", )
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $name = $request->get('name') ?: "Nenurodytas" ;
        $project = $request->get('project') ?: "Nenurodytas";

        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
            'title' => "Vertinimas",
            'name' => $name,
            'project' => $project
        ]);
    }
}
