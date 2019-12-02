<?php


namespace App\Service;


use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectRepository;

class LoginService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ObjectRepository
     */
    private $repositorio;

    public function __construct(UserRepository $userRepository, ObjectRepository $repositorio)
    {
        $this->userRepository = $userRepository;
        $this->repositorio = $repositorio;
    }

    public function realizaLogin($dados)
    {
        $login = json_decode($dados);
        $usuarios = $this->userRepository->findAll();

        $usuarioValido = false;

        foreach ($usuarios as $usuario){
            if($usuario->getEmail() == $login->email &&  password_verify($login->senha, $usuario->getSenha())){
                $usuarioValido = true;
                $arrayResposta = $this->repositorio->findBy([
                    "usuario" => $usuario->getId()
                ]);
                $usuarioLogado = $arrayResposta[0];
            }
        }
        if($usuarioValido){
            $retorno= array(
                "resposta" =>  $usuarioLogado,
                "codigo" => \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED //202
            );

            return $retorno;
        }else{
            $retorno= array(
                "resposta" => "Login Incorreto",
                "codigo" => \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED //401
            );
            return $retorno;
        }
    }
}