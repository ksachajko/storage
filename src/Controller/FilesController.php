<?php

namespace App\Controller;

use App\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FilesController extends AbstractController
{
    private $filesRepository;

    public function __construct(FilesRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
    }

    public function index()
    {
        return $this->render('files.html.twig', ['content' => $this->filesRepository->getAll()]);
    }
}
