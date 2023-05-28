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

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getIdUser()
    {
        return $this->attributes['id_user'];
    }

    public function getEstado()
    {
        return $this->attributes['estado'];
    }

    public function getCidade()
    {
        return $this->attributes['cidade'];
    }

    public function getEndereco()
    {
        return $this->attributes['endereco'];
    }

    public function getNumero()
    {
        return $this->attributes['numero'];
    }

    public function getComplemento()
    {
        return $this->attributes['complemento'];
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function setIdUser($idUser)
    {
        $this->attributes['id_user'] = $idUser;
    }

    public function setEstado($estado)
    {
        $this->attributes['estado'] = $estado;
    }

    public function setCidade($cidade)
    {
        $this->attributes['cidade'] = $cidade;
    }

    public function setEndereco($endereco)
    {
        $this->attributes['endereco'] = $endereco;
    }

    public function setNumero($numero)
    {
        $this->attributes['numero'] = $numero;
    }

    public function setComplemento($complemento)
    {
        $this->attributes['complemento'] = $complemento;
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}
