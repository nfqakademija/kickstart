<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/team", name="team")
     */
    public function index(KernelInterface $request)
    {
        $a = $request->getProjectDir();
        return $this->render('team/index.html.twig', [
            'controller_name' => $a,
        ]);
    }

    public function groupByStudents(array $projects)
    {
        $data1 = file_get_contents('https://hw1.nfq2019.online/students.json');
        foreach ($projects as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $data1[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }
        return $data1;
    }
}
