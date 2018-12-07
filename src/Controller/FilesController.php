<?php

namespace App\Controller;

use App\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('index.html.twig', ['keys' => $this->filesRepository->findAll()]);
    }

    public function search(Request $request)
    {
        $query = $request->query->get('query', '');

        return $this->render(
            'search.html.twig',
            [
                'keys' => $this->filesRepository->find($query),
                'query' => $query
            ]
        );
    }
}
