<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(Request $request)
    {
        $projects = json_decode(file_get_contents('https://nfq190418.realus.website/students.json'), true);

        if (false === array_key_exists($request->get('project'), $projects)) {
            return $this->render(Response::HTTP_NOT_FOUND);
        }

        return $this->render('student/index.html.twig', [
            'project' => $request->get('project'),
            'name' => $request->get('name'),
        ]);
    }
}
