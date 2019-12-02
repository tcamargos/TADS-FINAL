<?php

namespace App\Service;

interface EntidadeFactory
{
    public function criarEntidade(string $json);
    public function atualizaEntidade($entidadeExistente, $entidadeEnviada);
}