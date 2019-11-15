<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $studentsData = file_get_contents('https://hw1.nfq2019.online/students.json');

         return $this->render('home/index.html.twig', [
            'students' => $this->groupByStudents(json_decode($studentsData, true)),
         ]);
    }

    /**
     * @Route("/student", name="student")
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

    private function groupByStudents(array $projects)
    {
        $result = [];
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }
        return $result;
    }
}
