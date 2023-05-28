<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EnderecoEntity extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [];
    protected $attributes = [
        'id' => null,
        'id_user' => null,
        'estado' => null,
        'cidade' => null,
        'endereco' => null,
        'numero' => null,
        'complemento' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function getIdUser(): ?int
    {
        return $this->attributes['id_user'];
    }

    public function getEstado(): ?string
    {
        return $this->attributes['estado'];
    }

    public function getCidade(): ?string
    {
        return $this->attributes['cidade'];
    }

    public function getEndereco(): ?string
    {
        return $this->attributes['endereco'];
    }

    public function getNumero(): ?string
    {
        return $this->attributes['numero'];
    }

    public function getComplemento(): ?string
    {
        return $this->attributes['complemento'];
    }

    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function setId(?int $id)
    {
        $this->attributes['id'] = $id;
    }

    public function setIdUser(?int $idUser)
    {
        $this->attributes['id_user'] = $idUser;
    }

    public function setEstado(?string $estado)
    {
        $this->attributes['estado'] = $estado;
    }

    public function setCidade(?string $cidade)
    {
        $this->attributes['cidade'] = $cidade;
    }

    public function setEndereco(?string $endereco)
    {
        $this->attributes['endereco'] = $endereco;
    }

    public function setNumero(?string $numero)
    {
        $this->attributes['numero'] = $numero;
    }

    public function setComplemento(?string $complemento)
    {
        $this->attributes['complemento'] = $complemento;
    }

    public function setCreatedAt(?string $createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function setUpdatedAt(?string $updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}
