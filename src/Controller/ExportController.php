<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
    /**
     * @Route("/students.json", name="export")
     */
    public function index()
    {

        $data = [
            'nedarykpats' => [
                'name' => 'Nedaryk pats',
                'mentors' => [
                    'Laurynas'
                ],
                'students' => [
                    'Martyna',
                    'Aurimas',
                    'Vilius'
                ]
            ],
            'savanoryste' => [
                'name' => 'Car booking',
                'mentors' => [
                    'Tomas'
                ],
                'students' => [
                    'Ignas',
                    'Dovydas',
                    'Darius'
                ]
            ],
            'curlybrackets' => [
                'name' => 'Maisto dalinimosi sistema',
                'mentors' => [
                    'Paulius'
                ],
                'students' => [
                    'Roman',
                    'Marijus',
                    'Angelika'
                ]
            ],
            'hobby' => [
                'name' => 'Hobby',
                'mentors' => [
                    'Ieva'
                ],
                'students' => [
                    'Miroslav',
                    'Viktoras',
                    'Lukas'
                ]
            ],
            'hack<b>er</b>\'is po .mySubdomain &project=123' => [
                'name' => '\' OR 1 -- DROP DATABASE',
                'mentors' => [
                    '<b>Ponas</b> Programišius'
                ],
                'students' => [
                    'Aurelijus Banelis',
                    '<b>Ir</b> jo \"geras\" draug\'as'
                ]
            ],
        ];


        $response = new Response(json_encode($data, JSON_PRETTY_PRINT));
        $response->headers->set('Content-Type', 'application/json; charset=UTF-8');

        return $response;
    }
}
