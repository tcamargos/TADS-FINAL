<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\GestorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestorController extends AbstractController
{

    private $service;

    public function __construct(GestorService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/login", method="POST")
     */
    public function index(Request $request): Response
    {
        $dados = $request->getContent();
        $resposta = $this->service->logarGestor($dados);
        return new JsonResponse($resposta);
    }
}
