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
            $input = json_decode($request->getContent(), true)['input'];
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $projects = $this->getCommandNames();
        switch ($element) {
            case 'projectName':
                return new JsonResponse(['valid' => in_array(strtolower($input), $projects)]);
        }
        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }

//

    /**
     * @return array
     */
    private function getCommandNames(): array {
        $data = json_decode(file_get_contents(__DIR__.'/../../public/students.json'), true);
        $commandNames = [];
        foreach ($data as $commandName => $projectName) {
            $commandNames[] = strtolower($commandName);
        }
        return $commandNames;
    }
}


