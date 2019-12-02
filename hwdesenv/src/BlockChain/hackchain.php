<?php
require_once(__DIR__.'/Atestado.php');
use App\BlockChain\BlockAtestado;

/*
Hack the chain, changing values in the first block.
*/

/*$testCoin = new BlockChain();

echo "mining block 1...\n";
$testCoin->push(new Block( strtotime("now"), "amount: 4", "1234"));

echo "mining block 2...\n";
$testCoin->push(new Block( strtotime("now"), "amount: 10", "1234"));

echo "Chain valid: ".($testCoin->isValid() ? "true" : "false")."\n";

echo "Changing second block...\n";
$testCoin->chain[1]->crm = "1000";
$testCoin->chain[1]->hash = $testCoin->chain[1]->calculateHash();

echo "Chain valid: ".($testCoin->isValid() ? "true" : "false")."\n";
*/

$atestado1 = new Atestado("2019-01-01","125548", "Tiago", "033926251", "024", "3");
$atestado2 = new Atestado("2019-05-04","188948", "Nany", "033951", "025", "2");
$atestado3 = new Atestado("2019-09-05","855968", "Rock", "033926251", "027", "6");
$atestado4 = new Atestado("2019-10-12","999999", "Juca", "03389965", "028", "1");

$pdo = new BlockAtestado();

$pdo->adicionarAtestado($atestado1);
$pdo->adicionarAtestado($atestado2);
$pdo->adicionarAtestado($atestado3);
$pdo->adicionarAtestado($atestado4);