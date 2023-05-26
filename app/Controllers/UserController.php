<?php

namespace App\Controllers;

use App\Models\UserModel;
use Firebase\JWT\JWT;

class UserController extends BaseController
{
    public function register_user()
    {
        $fields = [
            "user_name" => "required",
            "user_email" => "required|valid_email",
            "user_password" => "required",
        ];
        if (!$this->validate($fields)) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => true,
                'message' => 'Erro de validação',
                'errors' => $this->validator->getErrors()
            ]);
        };
        $user_name = strval($this->request->getPost("user_name"));
        $user_email = strval($this->request->getPost("user_email"));
        $user_password = strval($this->request->getPost("user_password"));
        $UserModel = new UserModel();
        if (!empty($UserModel->searchUser_by_name($user_name))) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => true,
                'message' => 'Usuario ja existe',
                'errors' => $this->validator->getErrors()
            ]);
        }
        if (!empty($UserModel->searchUser_by_email($user_email))) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => true,
                'message' => 'Email ja utilizado',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $UserModel->registerUser(
            $user_name,
            $user_email,
            $user_password
        );
        return $this->response->setJSON([
            "susses" => true,
            'message' => 'Usuario registrado',
        ]);
    }
    public function update_user()
    {
        $fields = [
            "id" => "required",
            "user_name" => "required",
            "user_email" => "required|valid_email",
        ];
        if (!$this->validate($fields)) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => true,
                'message' => 'Erro de validação',
                'errors' => $this->validator->getErrors()
            ]);
        };
        $id = intval($this->request->getPost("id"));
        $user_name = strval($this->request->getPost("user_name"));
        $user_email = strval($this->request->getPost("user_email"));
        $UserModel = new UserModel();
        if (empty($UserModel->getUser_by_id($id))) {
            $UserModel->getUser_by_id($id);
            return $this->response->setStatusCode(400)->setJSON([
                'error' => true,
                'message' => 'Unusario nao existe',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $UserModel->updateUser($id, $user_name, $user_email);
        return $this->response->setJSON([
            "susses" => true,
            'message' => 'Usuario atualizado',
        ]);
    }
}
