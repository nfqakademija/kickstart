<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeopleController extends AbstractController
{
    /**
     * @Route("/people", name="people")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('people/index.html.twig', [
            'controller_name' => 'PeopleController',
        ]);
    }

    /**
     * @Route(
     *     "/validate/{element}",
     *     name="validate",
     *     requirements={"POST"}
     * )
     * @param Request $request
     * @param string $element
     * @return JsonResponse
     */
    public function validate(Request $request, string $element): JsonResponse
    {
        try {
            $input = json_decode($request->getContent(), true)['input'];
        } catch (Exception $e) {
            return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $students = $this->getStudents();
        $teams = $this->getTeams();

        switch ($element) {
            case 'name':
                return new JsonResponse(['valid' => in_array(strtolower($input), $students, true)]);
            case 'team':
                return new JsonResponse(['valid' => in_array(strtolower($input), $teams, true)]);
        }

        return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
    }

    private function getStorage()
    {
        return /** @lang json */
            '{
          "nedarykpats": {
            "name": "Nedaryk pats",
            "mentors": [
              "Laurynas"
            ],
            "students": [
              "Martyna",
              "Aurimas",
              "Vilius"
            ]
          },
          "savanoryste": {
            "name": "Car booking",
            "mentors": [
              "Tomas"
            ],
            "students": [
              "Ignas",
              "Dovydas",
              "Darius"
            ]
          },
          "curlybrackets": {
            "name": "Maisto dalinimosi sistema",
            "mentors": [
              "Paulius"
            ],
            "students": [
              "Roman",
              "Marijus",
              "Angelika"
            ]
          },
          "hobby": {
            "name": "Hobby",
            "mentors": [
              "Ieva"
            ],
            "students": [
              "Miroslav",
              "Viktoras",
              "Lukas"
            ]
          },
          "hack<b>er</b>\'is po .mySubdomain &project=123": {
            "name": "\' OR 1 -- DROP DATABASE",
            "mentors": [
              "<b>Ponas</b> Programišius"
            ],
            "students": [
              "Aurelijus Banelis",
              "<b>Ir</b> jo \"geras\" draug\'as"
            ]
          }
        }';
    }

    /**
     * @return array
     */
    private function getStudents(): array
    {
        $students = [];
        $storage = json_decode($this->getStorage(), true);
        foreach ($storage as $teamData) {
            foreach ($teamData['students'] as $student) {
                $students[] = strtolower($student);
            }
        }
        return $students;
    }

    /**
     * @return array
     */
    private function getTeams(): array
    {
        $teams = [];
        $storage = json_decode($this->getStorage(), true);
        foreach ($storage as $teamData) {
            $teams[] = strtolower($teamData['name']);
        }

        return $teams;
    }
}
