<?php


namespace App\Service;


use App\BlockChain\BlockAtestado;
use App\Entity\UserEmpresa;
use App\Entity\UserMedico;
use App\Repository\UserEmpresaRepository;
use App\Repository\UserMedicoRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Flex\Response;

class EmpresaService extends LoginService
{
    /**
     * @var UserFactory
     */
    private $userFactory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserMedicoRepository
     */
    private $empresaRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    public function __construct(UserFactory $userFactory, EntityManagerInterface $entityManager, UserEmpresaRepository $repository, UserRepository $userRepository)
    {
        $this->userFactory = $userFactory;
        $this->entityManager = $entityManager;
        $this->empresaRepository = $repository;
        $this->userRepository = $userRepository;
        parent::__construct($userRepository, $repository);
    }

    public function criarEntidade(string $json)
    {
        $dados = json_decode($json);

        $cnpjInexistente = true;
        $emailInexistente = true;

        $listaEmpresa = $this->empresaRepository->findAll();
        $listaUsuarios = $this->userRepository->findAll();

        foreach ($listaEmpresa as $empresa){
            if($empresa->getCnpj() == $dados->cnpj){
                $cnpjInexistente = false;
            }
        }
        foreach ($listaUsuarios as $usuario){
            if($usuario->getEmail() == $dados->email){
                $emailInexistente = false;
            }
        }
        if($cnpjInexistente && $emailInexistente){
            if(isset($dados->id)){
                $empresaCadastrada = $this->empresaRepository->find($dados->id);
                $usuario = $empresaCadastrada->getUsuario();
                $this->userFactory->atualizaEntidade($usuario, $dados);

                $empresaCadastrada->setEndereco($dados->endereco);
                $empresaCadastrada->setCnpj($dados->cnpj);
                $empresaCadastrada->setNome($dados->nome);
                $empresaCadastrada->setServico($dados->servico);
                $empresaCadastrada->setUsuario($usuario);

                $this->entityManager->flush();

                $retorno= array(
                    "resposta" => $empresaCadastrada,
                    "codigo" => \Symfony\Component\HttpFoundation\Response::HTTP_CREATED //201
                );
                return $retorno;

            }else{
                $usuario = $this->userFactory->criarEntidade($json);
                $this->entityManager->persist($usuario);
                $this->entityManager->flush();

                $usuario = $this->userRepository->findBy([
                    "email" => $dados->email
                ]);

                $empresa = new UserEmpresa();

                $empresa->setNome($dados->nome);
                $empresa->setCnpj($dados->cnpj);
                $empresa->setEndereco($dados->endereco);
                $empresa->setServico($dados->servico);
                $empresa->setUsuario($usuario[0]);

                $this->entityManager->persist($empresa);
                $this->entityManager->flush();

                $retorno= array(
                    "resposta" => "Empresa cadastrada com sucesso",
                    "codigo" => \Symfony\Component\HttpFoundation\Response::HTTP_CREATED //201
                );
                return $retorno;

            }
        }else{
            $resposta = "Erro - ";

            if(!$emailInexistente){
                $resposta .= "Email ja cadastrado - ";
            }
            if(!$cnpjInexistente){
                $resposta .= "CNPJ ja cadastrado";
            }
            $retorno= array(
                "resposta" => $resposta,
                "codigo" => \Symfony\Component\HttpFoundation\Response::HTTP_IM_USED
            );
            return $retorno;
        }
    }

    public function buscaAtestado($dados)
    {
        $dadosFormatados = json_decode($dados);

        $blockChain = new BlockAtestado();
        $resposta = $blockChain->buscarAtestado($dadosFormatados->cpf, $dadosFormatados->codigo);

        return $resposta;
    }
}