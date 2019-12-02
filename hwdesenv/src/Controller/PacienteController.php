<?php

namespace App\Controller;


use App\Service\PacienteService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PacienteController extends AbstractController
{
    /**
     * @var PacienteService
     */
    private $service;

    public function __construct(PacienteService $service)
    {
        $this->service = $service;
    }
    /**
     * @Route("/pacientes/create", methods={"POST"})
     */
    public function novoPaciente(Request $request): Response
    {
        $resposta = $this->service->criarEntidade($request->getContent());

        return new JsonResponse($resposta["resposta"], $resposta["codigo"]);
    }
    /**
     * @Route("/pacientes/login", methods={"POST"})
     */
    public function login(Request $request): Response
    {
        $resposta = $this->service->realizaLogin($request->getContent());

        return new JsonResponse($resposta["resposta"], $resposta["codigo"]);
    }
    /**
     * @Route("/pacientes/atestados", methods={"GET"})
     */
    public function buscarAtestados(Request $request): Response
    {
        $resposta = $this->service->buscarAtestados($request->getContent());

        return new JsonResponse($resposta["retorno"], $resposta["codigo"]);
    }
}
