<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserMedicoRepository")
 */
class UserMedico implements \JsonSerializable
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
     * @ORM\Column(type="string", length=25)
     */
    private $crm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endereco;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MensagemMedico", mappedBy="empresa")
     */
    private $mensagemMedicos;

    public function __construct()
    {
        $this->mensagemMedicos = new ArrayCollection();
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

    public function getCrm(): ?string
    {
        return $this->crm;
    }

    public function setCrm(string $crm): self
    {
        $this->crm = $crm;

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
     * @return Collection|MensagemMedico[]
     */
    public function getMensagemMedicos(): Collection
    {
        return $this->mensagemMedicos;
    }

    public function addMensagemMedico(MensagemMedico $mensagemMedico): self
    {
        if (!$this->mensagemMedicos->contains($mensagemMedico)) {
            $this->mensagemMedicos[] = $mensagemMedico;
            $mensagemMedico->setEmpresa($this);
        }

        return $this;
    }

    public function removeMensagemMedico(MensagemMedico $mensagemMedico): self
    {
        if ($this->mensagemMedicos->contains($mensagemMedico)) {
            $this->mensagemMedicos->removeElement($mensagemMedico);
            // set the owning side to null (unless already changed)
            if ($mensagemMedico->getEmpresa() === $this) {
                $mensagemMedico->setEmpresa(null);
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
            "Nome" => $this->getNome(),
            "CRM" => $this->getCrm(),
            "Endereco" => $this->getEndereco(),
            "Usuario" => $this->getUsuario()
        ];
    }
}
