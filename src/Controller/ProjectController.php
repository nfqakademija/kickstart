<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/validate/{element}", name="validatePerson")
     * @Method({"POST"})
     * @param string $element
     *
     * @return JsonResponse
     */
    public function validate(string $element)
    {
        switch ($element) {
            case 'projectName':
                return new JsonResponse(['valid' => true]);
        }
        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }
}



