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
        $enderecoEntity->id_user = $this->request->getPost('id_user');
        $enderecoEntity->estado = $this->request->getPost('estado');
        $enderecoEntity->cidade = $this->request->getPost('cidade');
        $enderecoEntity->endereco = $this->request->getPost('endereco');
        $enderecoEntity->numero = $this->request->getPost('numero');
        $enderecoEntity->complemento = $this->request->getPost('complemento');
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
}
