<?php

namespace App\Controllers;

use App\Models\UserModel;
use Firebase\JWT\JWT;

class UserController extends BaseController
{
    public function login()
    {
        $fields = [
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
        $user_email = $this->request->getPost("user_email");
        $user_password = $this->request->getPost("user_password");
        $UserModel = new UserModel();
        if (empty($UserModel->existUser($user_email))) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => true,
                'message' => 'Usuario inexistente',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $get_user = $UserModel->login($user_email, $user_password);
        if (empty($get_user)) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => true,
                'message' => 'Usuario ou Senha invalidos',
                'errors' => $this->validator->getErrors()
            ]);
        }
        return $this->response->setJSON([
            "susses" => true,
            "message" => 'Usuario logado',
            "token" => $this->generateJWT([
                "user_name" => $get_user["user_name"],
                "user_email" => $get_user["user_email"]
            ])
        ]);
    }
    /**
     * @filter('auth')
     */
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
        $user_name = $this->request->getPost("user_name");
        $user_email = $this->request->getPost("user_email");
        $user_password = $this->request->getPost("user_password");
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
    private function generateJWT(array $payload)
    {
        $key = '869f468b932f4dffff7acd140b97421e420d36deb354a8c9e5ee1144685f9de0';
        return JWT::encode($payload, $key, "HS256");
    }
}
