<?php

namespace App\BlockChain;
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 07/10/19
 * Time: 16:24
 */

class Atestado
{
    public $nonce;

    public function __construct($timestamp,$crm, $nome, $cpf, $cid, $dias, $previousHash = null)
    {
        $this->timestamp = $timestamp;
        $this->crm = $crm;
        $this->previousHash = $previousHash;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->cid = $cid;
        $this->dias = $dias;
        $this->nonce = 0;
        $this->hash = $this->calculateHash();
    }

    public function calculateHash()
    {
        return hash("sha256",
            $this->previousHash.
            $this->timestamp.
            $this->crm.
            $this->nome.
            $this->cpf.
            $this->cid.
            $this->dias.
            $this->nonce
        );
    }
}