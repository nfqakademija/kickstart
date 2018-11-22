<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class StudentsController extends AbstractController
{
    public function show(Request $request)
    {
        return $this->render('students/show.html.twig', [
            'name' => $request->get('name'),
            'project' => $request->get('project'),
        ]);
    }
}
