<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        $studentContentJson = file_get_contents('../data/students.json');
        $contentJson = json_decode($studentContentJson, true);

        $students = $this->groupByStudents($contentJson);
        $projects = $this->groupByProjects($contentJson);

        return $this->render('home/index.html.twig', [
            'title' => "Projektai",
            'projects' => $projects,
            'students' => $students,
        ]);
    }

    /**
     * @param $contentJson
     * @return array
     */
    private function groupByStudents($contentJson): array
    {
        $result = [];
        foreach ($contentJson as $projectName => $project) {
            foreach ($project['students'] as $student) {
                $result[] = ['student' => $student, 'project' => $projectName, 'mentors' => $project['mentors']];
            }
        }
        return $result;
    }

    /**
     * @param $contentJson
     * @return array
     */
    private function groupByProjects($contentJson): array
    {
        $array = array_combine(array_keys($contentJson), array_column($contentJson, 'name'));

        return $array;
    }
}
