<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\EnderecoEntity;
use App\Models\EnderecoModel;
use App\Models\UserModel;

class EnderecoController extends BaseController
{
    public function register_endereco()
    {
        $fields = [
            'id_user' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'complemento' => 'required',
        ];
        if (!$this->validate($fields)) {
            return $this->validationErrorResponse();
        };
        $enderecoEntity = new EnderecoEntity();
        $enderecoEntity->id_user = $this->request->getVar('id_user');
        $enderecoEntity->estado = $this->request->getVar('estado');
        $enderecoEntity->cidade = $this->request->getVar('cidade');
        $enderecoEntity->endereco = $this->request->getVar('endereco');
        $enderecoEntity->numero = $this->request->getVar('numero');
        $enderecoEntity->complemento = $this->request->getVar('complemento');
        $enderecoEntity->created_at = date('Y-m-d H:i:s');
        $enderecoEntity->updated_at = date('Y-m-d H:i:s');
        $UserModel = new UserModel();
        $get_user = $UserModel->getUser_by_id(intval($enderecoEntity->id_user));
        if (empty($get_user)) {
            return $this->errorResponse("Usuario nao existe");
        }
        $enderecoModel = new EnderecoModel();
        $enderecoModel->insert($enderecoEntity);
        return $this->successResponse("Endereco registrado ao usuario $get_user[user_name]");
    }
    public function get_all_endereco()
    {
        $EnderecoModel = new EnderecoModel();
        $payload = array_map(function ($index) {
            return [
                "nome" => $index["user_name"],
                "estado" => $index["estado"],
                "cidade" => $index["cidade"],
                "endereco" => $index["endereco"],
                "numero" => $index["numero"],
                "complemento" => $index["complemento"],
            ];
        }, $EnderecoModel->join("users", "users.id = id_user")->findAll());
        return $this->successResponse("Todos Enderecos", $payload);
    }
}
