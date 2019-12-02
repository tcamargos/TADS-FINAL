<?php

namespace App\Service;

use App\BlockChain\Atestado;
use App\BlockChain\BlockAtestado;
use App\Entity\UserMedico;
use App\Repository\UserMedicoRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class MedicoService extends LoginService
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
    private $medicoRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserFactory $userFactory, EntityManagerInterface $entityManager, UserMedicoRepository $repository, UserRepository $userRepository)
    {

        $this->userFactory = $userFactory;
        $this->entityManager = $entityManager;
        $this->medicoRepository = $repository;
        $this->userRepository = $userRepository;
        parent::__construct($userRepository, $repository);
    }

    public function criarEntidade(string $json)
    {

        $dados = json_decode($json);

        $crmInexistente = true;
        $emailInexistente = true;

        $listaMedicos = $this->medicoRepository->findAll();
        $listaUsuarios = $this->userRepository->findAll();

        foreach ($listaMedicos as $medico){
            if($medico->getCrm() == $dados->crm){
                $crmInexistente = false;
            }
        }

        foreach ($listaUsuarios as $usuario){
            if($usuario->getEmail() == $dados->email){
                $emailInexistente = false;
            }
        }
        if($crmInexistente && $emailInexistente){
            if(isset($dados->id))
            {

                $medicoCadastrado = $this->medicoRepository->find($dados->id);
                $usuario = $medicoCadastrado->getUsuario();
                $this->userFactory->atualizaEntidade($usuario, $dados);

                $medicoCadastrado->setEndereco($dados->endereco);
                $medicoCadastrado->setCrm($dados->crm);
                $medicoCadastrado->setNome($dados->nome);
                $medicoCadastrado->setUsuario($usuario);

                $this->entityManager->flush();

                $retorno= array(
                    "resposta" => $medicoCadastrado,
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

                $medico = new UserMedico();

                $medico->setNome($dados->nome);
                $medico->setCrm($dados->crm);
                $medico->setEndereco($dados->endereco);
                $medico->setUsuario($usuario[0]);

                $this->entityManager->persist($medico);
                $this->entityManager->flush();

                $retorno= array(
                    "resposta" => "Medico cadastrado com sucesso",
                    "codigo" => \Symfony\Component\HttpFoundation\Response::HTTP_CREATED //201
                );
                return $retorno;
            }
        }else{
            $resposta = "Erro - ";

            if(!$emailInexistente){
                $resposta .= "Email ja cadastrado - ";
            }
            if(!$crmInexistente){
                $resposta .= "CRM ja cadastrado";
            }

            $retorno= array(
                "resposta" => $resposta,
                "codigo" => \Symfony\Component\HttpFoundation\Response::HTTP_IM_USED //226
            );
            return $retorno;
        }
    }
    public function criarAtestado($dados)
    {
        $dadosFormatados = json_decode($dados);
        $atestado = new Atestado($dadosFormatados->data,$dadosFormatados->crm, $dadosFormatados->nome, $dadosFormatados->cpf, $dadosFormatados->cid, $dadosFormatados->dias);
        $blockChain = new BlockAtestado();

        $resposta = $blockChain->adicionarAtestado($atestado);

        return $resposta;

    }
    public function valida()
    {
        $blockChain = new BlockAtestado();
        return $blockChain->isValid();
    }

}