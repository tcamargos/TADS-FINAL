<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserEmpresaRepository")
 */
class UserEmpresa implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $cnpj;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endereco;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $servico;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MensagemEmpresa", mappedBy="empresa")
     */
    private $mensagemEmpresas;

    public function __construct()
    {
        $this->mensagemEmpresas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getServico(): ?string
    {
        return $this->servico;
    }

    public function setServico(string $servico): self
    {
        $this->servico = $servico;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection|MensagemEmpresa[]
     */
    public function getMensagemEmpresas(): Collection
    {
        return $this->mensagemEmpresas;
    }

    public function addMensagemEmpresa(MensagemEmpresa $mensagemEmpresa): self
    {
        if (!$this->mensagemEmpresas->contains($mensagemEmpresa)) {
            $this->mensagemEmpresas[] = $mensagemEmpresa;
            $mensagemEmpresa->setEmpresa($this);
        }

        return $this;
    }

    public function removeMensagemEmpresa(MensagemEmpresa $mensagemEmpresa): self
    {
        if ($this->mensagemEmpresas->contains($mensagemEmpresa)) {
            $this->mensagemEmpresas->removeElement($mensagemEmpresa);
            // set the owning side to null (unless already changed)
            if ($mensagemEmpresa->getEmpresa() === $this) {
                $mensagemEmpresa->setEmpresa(null);
            }
        }

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
          "id"=>$this->getId(),
          "nome"=>$this->getNome(),
          "cnpj"=>$this->getCnpj(),
          "endereco"=>$this->getEndereco(),
          "servico"=>$this->getServico(),
          "usuario"=>$this->getUsuario()
        ];
    }
}
