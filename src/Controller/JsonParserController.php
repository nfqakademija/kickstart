<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;

class JsonParserController extends AbstractController
{
    public static function getStudentData() :?array
    {
        try {
            $json = file_get_contents('students.json');
            return json_decode($json, true);
        } catch (\Exception $e) {
            return [
                'error'     => $e->getMessage()
            ];
        }
    }
}
