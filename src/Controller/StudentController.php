<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../public/data.json'), true);

        return $this->render(
            'student/index.html.twig',
            [
                'data' => $data,
            ]
        );
    }

    /**
     * @Route("/student")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request)
    {
        $name = $request->query->get('name');
        $project = $request->query->get('project');

        return $this->render(
            'student/show.html.twig',
            [
                'name' => $name,
                'project' => $project,
            ]
        );
    }

    /**
     * @Route("/data")
     */
    public function getList()
    {
        $data = json_decode(file_get_contents(__DIR__.'/../../public/data.json'), true);

        return $this->json($data);
    }
}
