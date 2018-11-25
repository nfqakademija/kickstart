<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project")
     */
    public function index()
    {
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }

    /**
     * @Route("/validate/{element}", name="validate")
     * @Method({"POST"})
     * @param Request $request
     * @param string  $element
     *
     * @return JsonResponse
     */
    public function validate(Request $request, $element)
    {

        try {
            $commandName = json_decode($request->getContent(), true)['commandName'];
            $studentName = json_decode($request->getContent(), true)['studentName'];
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        switch ($element) {
            case 'commandName':
                $commandNames = $this->getCommandNames();
                return new JsonResponse(['valid' => in_array(strtolower($commandName), $commandNames)]);
                break;

            case 'studentName':
                $studentNames = $this->getStudents();
                return new JsonResponse(['valid' => in_array(strtolower($studentName), $studentNames)]);
                break;
        }

        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @return array
     */
    private function getCommandNames(): array {
        $commandNames = [];
        $data = json_decode(file_get_contents(__DIR__.'/../../public/students.json'), true);
        foreach ($data as $commandName => $value) {
            $commandNames[] = strtolower($commandName);
        }
        return $commandNames;
    }

    /**
     * @return array
     */
    private function getStudents(): array {
        $students = [];
        $data = json_decode(file_get_contents(__DIR__.'/../../public/students.json'), true);
        foreach ($data as $teamData) {
            foreach ($teamData['students'] as $student) {
                $students[] = strtolower($student);
            }
        }
        return $students;
    }
}


