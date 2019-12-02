<?php

namespace App\Controller;

use App\Service\EmpresaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmpresaController extends AbstractController
{
    /**
     * @var EmpresaService
     */
    private $service;

    public function __construct(EmpresaService $service)
    {
        $this->service = $service;
    }
    /**
     * @Route("/empresas/create", methods={"POST"})
     */
    public function novaEmpresa(Request $request): Response
    {
        $resposta = $this->service->criarEntidade($request->getContent());

        return new JsonResponse($resposta["resposta"], $resposta["codigo"]);
    }
    /**
     * @Route("/empresas/login", methods={"POST"})
     */
    public function login(Request $request): Response
    {
        $resposta = $this->service->realizaLogin($request->getContent());

        return new JsonResponse($resposta["resposta"], $resposta["codigo"]);
    }
    /**
     * @Route("/empresas/update", methods={"PUT"})
     */
    public function atualizar(Request $request): Response
    {
        $dados = $request->getContent();
        $resposta =  $this->service->criarEntidade($dados);

        return new JsonResponse($resposta["resposta"], $resposta["codigo"]);
    }
    /**
     * @Route("/empresas/atestados", methods={"GET"})
     */
    public function pesquisaAtestados(Request $request):Response
    {
        $dados = $request->getContent();
        $resposta = $this->service->buscaAtestado($dados);

        return new JsonResponse($resposta["retorno"], $resposta["codigo"]);
    }
}
