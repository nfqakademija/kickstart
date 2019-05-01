<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
    /**
     * @param KernelInterface $kernel
     * @return BinaryFileResponse
     * @Route("/students.json", name="export")
     */
    public function index(KernelInterface $kernel)
    {
        $path = $kernel->getProjectDir() . '/public/json/students.json';

        return $this->file($path, 'students.json', ResponseHeaderBag::DISPOSITION_INLINE);
    }
}
