<?php


namespace App\Service;


class GestorService
{
    /*
     * Login padrao para Gestor
     */
    public function logarGestor($dados)
    {
        $dados = json_decode($dados);

        if($dados->email == 'admin' && $dados->senha == 'admin'){
            return true;
        } else {
            return false;
        }

    }
}