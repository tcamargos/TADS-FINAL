<?php
namespace App\BlockChain;

use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 07/10/19
 * Time: 16:24
 */


define('DB_DRIVE', 'mysql');
define('DB_HOSTNAME', '127.0.0.1:3307');
define('DB_DATABASE', 'blockchain');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'mysql');



class BlockAtestado
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new \PDO(DB_DRIVE .':host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    }
    public function buscarAtestadosPaciente($cpf)
    {
   
        $resposta = array();
        try{
            $query = "Select * from atestados where cpf = :cpf";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(":cpf", $cpf);
            $stmt->execute();
            $atestados = $stmt->fetchAll();

            if(isset($atestados)){
                $resposta["retorno"] = $atestados;
                $resposta["codigo"] = Response::HTTP_ACCEPTED;
            }else{
                $resposta["retorno"] = "Não Encontrado";
                $resposta["codigo"] = Response::HTTP_NOT_FOUND;
            }
        }catch (\Exception $e){
            $resposta["retorno"] = $e->getMessage();
            $resposta["codigo"] = Response::HTTP_NO_CONTENT;
        }

        return $resposta;
    }
    public function buscarAtestado($cpf, $nonce)
    {
        $resposta = array();
        try{
            $query = "Select * from atestados where cpf = :cpf and nonce = :nonce";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(":cpf", $cpf);
            $stmt->bindValue(":nonce", $nonce);
            $stmt->execute();
            $atestado = $stmt->fetch();

            if(isset($atestado)){
                $resposta["retorno"] = $atestado;
                $resposta["codigo"] = Response::HTTP_ACCEPTED;
            }else{
                $resposta["retorno"] = "Não Encontrado";
                $resposta["codigo"] = Response::HTTP_NOT_FOUND;
            }
        }catch (\Exception $e){
            $resposta["retorno"] = $e->getMessage();
            $resposta["codigo"] = Response::HTTP_NO_CONTENT;
        }

        return $resposta;
    }
    public function adicionarAtestado(Atestado $block)
    {
        $resposta = array();
        try{
            $query = "SELECT hash from atestados where id = (Select MAX(id) from atestados)";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            $ultimoAtestado = $stmt->fetch();
            $block->previousHash = $ultimoAtestado[0];
            $atestado = $this->mine($block);

            $query = "INSERT INTO atestados(hash, previoushash,timestamp,nonce,nome,cpf,crm,cid,dias)
                  values (:hash, :previoushash, :timestamp, :nonce, :nome, :cpf, :crm, :cid, :dias)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(":nome", $atestado->nome);
            $stmt->bindValue(":cpf", $atestado->cpf);
            $stmt->bindValue(":crm", $atestado->crm);
            $stmt->bindValue(":dias", $atestado->dias );
            $stmt->bindValue(":hash", $atestado->hash);
            $stmt->bindValue(":nonce", $atestado->nonce);
            $stmt->bindValue(":previoushash", $atestado->previousHash);
            $stmt->bindValue(":timestamp", $atestado->timestamp);
            $stmt->bindValue(":cid", $atestado->cid);
            $stmt->execute();

            $resposta["mensagem"] = $atestado->nonce;
            $resposta["codigo"] = Response::HTTP_CREATED;

        }catch(Exception $e){
            $resposta["mensagem"] = $e->getMessage();
            $resposta["codigo"] = Response::HTTP_NO_CONTENT;
        }

        return $resposta;
    }
    /**
     * Mines a block.
     */
    public function mine($block)
    {
        while (substr($block->hash, 0, 4) !== str_repeat("0", 4)) {
            $block->nonce++;
            $block->hash = $this->calculateHash($block);
        }
        return $block;
    }
    public function calculateHash($block)
    {
        return hash("sha256",
            $block->previousHash.
            $block->timestamp.
            $block->crm.
            $block->nome.
            $block->cpf.
            $block->cid.
            $block->dias.
            $block->nonce
        );
    }
    public function isValid()
    {
        $query = "SELECT * from atestados";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        $listaAtestados = $stmt->fetchAll();


        for ($i = 1; $i < count($listaAtestados); $i++) {
            $currentBlock = $listaAtestados[$i];
            $previousBlock = $listaAtestados[$i-1];


            $hash1 = $currentBlock['hash'];
            $hash2 = hash("sha256", $currentBlock['previoushash'].
                $currentBlock['timestamp'].
                $currentBlock['crm'].
                $currentBlock['nome'].
                $currentBlock['cpf'].
                $currentBlock['cid'].
                $currentBlock['dias'].
                $currentBlock['nonce']
            );



            if ($hash1 != $hash2) {
                return false;

            }

            if ($currentBlock['previoushash'] != $previousBlock['hash']) {
                return false;

            }
        }

        return true;
    }
}