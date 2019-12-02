<?php


namespace App\Service;


use App\BlockChain\BlockAtestado;
use App\Entity\UserPaciente;
use App\Repository\UserPacienteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class PacienteService extends LoginService
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
     * @var UserPacienteRepository
     */
    private $pacienteRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserFactory $userFactory, EntityManagerInterface $entityManager, UserPacienteRepository $repository, UserRepository $userRepository)
    {
        $this->userFactory = $userFactory;
        $this->entityManager = $entityManager;
        $this->pacienteRepository = $repository;
        $this->userRepository = $userRepository;
        parent::__construct($userRepository, $repository);
    }

    public function criarEntidade(string $json)
    {
        $dados = json_decode($json);
       
        $crmInexistente = true;
        $emailInexistente = true;

        $listaPaciente = $this->pacienteRepository->findAll();
        $listaUsuarios = $this->userRepository->findAll();

        foreach ($listaPaciente as $paciente){
            if($paciente->getCpf() == $dados->cpf){
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

                $pacienteCadastrado = $this->pacienteRepository->find($dados->id);
                $usuario = $pacienteCadastrado->getUsuario();
                $this->userFactory->atualizaEntidade($usuario, $dados);

                $pacienteCadastrado->setTelefone($dados->telefone);
                $pacienteCadastrado->setCpf($dados->cpf);
                $pacienteCadastrado->setNome($dados->nome);
                $pacienteCadastrado->setCep($dados->cep);
                $pacienteCadastrado->setUf($dados->uf);
                $pacienteCadastrado->setCidade($dados->cidade);
                $pacienteCadastrado->setRua($dados->rua);
                $pacienteCadastrado->setNumero($dados->numero);
                $pacienteCadastrado->setUsuario($usuario);

                $this->entityManager->flush();

                $retorno= array(
                    "resposta" => $pacienteCadastrado,
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

                $paciente = new UserPaciente();

                $paciente->setTelefone($dados->telefone);
                $paciente->setNome($dados->nome);
                $paciente->setCpf($dados->cpf);
                $paciente->setCep($dados->cep);
                $paciente->setUf($dados->uf);
                $paciente->setCidade($dados->cidade);
                $paciente->setRua($dados->rua);
                $paciente->setNumero($dados->numero);
                $paciente->setUsuario($usuario[0]);

                $this->entityManager->persist($paciente);
                $this->entityManager->flush();

                $retorno= array(
                    "resposta" => "Paciente cadastrado com sucesso",
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

    public function buscarAtestados($dados)
    {
        $dadosFormatados = json_decode($dados);
        $blockChain = new BlockAtestado();

        $resposta = $blockChain->buscarAtestadosPaciente($dadosFormatados->cpf);

        return $resposta;
    }
}