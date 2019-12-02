<?php


namespace App\Controller;
use App\Service\MedicoService;
use App\Repository\UserMedicoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedicoController extends AbstractController
{

    /**
     * @var MedicoService
     */
    private $service;

    public function __construct(MedicoService $service)
    {
        $this->service = $service;
    }
    /**
     * @Route("/medicos/create", methods={"POST"})
     */
    public function novoMedico(Request $request): Response
    {
        $resposta = $this->service->criarEntidade($request->getContent());

        return new JsonResponse($resposta["resposta"], $resposta["codigo"]);
    }
    /**
     * @Route("/medicos/login", methods={"POST"})
     */
    public function login(Request $request): Response
    {
        $resposta = $this->service->realizaLogin($request->getContent());

        return new JsonResponse($resposta["resposta"], $resposta["codigo"]);
    }

    /**
     * @Route("/medicos/update", methods={"PUT"})
     */
    public function atualizar(Request $request): Response
    {
        $dados = $request->getContent();
        $resposta =  $this->service->criarEntidade($dados);

        return new JsonResponse($resposta["resposta"], $resposta["codigo"]);
    }

    /**
     * @Route("/medicos/atestados", methods={"POST"})
     */
    public function criaAtestado(Request $request):Response
    {
        $dados = $request->getContent();

        $resposta = $this->service->criarAtestado($dados);

        return new JsonResponse($resposta["mensagem"], $resposta["codigo"]);
    }
    /**
     * @Route("/medicos/atestados", methods={"GET"})
     */
    public function validaAtestado():Response
    {
        return new JsonResponse($this->service->valida());
    }
}