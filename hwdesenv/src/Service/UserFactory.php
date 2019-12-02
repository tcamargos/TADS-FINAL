<?php


namespace App\Service;


use App\Entity\User;

class UserFactory implements EntidadeFactory
{

    public function criarEntidade(string $json)
    {
        $dados = json_decode($json);
        $user = new User();

        $user->setEmail($dados->email);
        $user->setSenha(password_hash($dados->senha, PASSWORD_DEFAULT));

        return $user;
    }

    /**
     * @param User $entidadeExistente
    */
    public function atualizaEntidade($entidadeExistente,$entidadeEnviada)
    {
       $entidadeExistente->setSenha($entidadeEnviada->senha);
       $entidadeExistente->setEmail($entidadeEnviada->email);
    }
}