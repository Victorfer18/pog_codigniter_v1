<?php

namespace App\Controllers;

use App\Models\UserModel;
use Firebase\JWT\JWT;

class LoginController extends BaseController
{
    public function index()
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
        $user_email = strval($this->request->getPost("user_email"));
        $user_password = strval($this->request->getPost("user_password"));
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
        $key = "869f468b932f4dffff7acd140b97421e420d36deb354a8c9e5ee1144685f9de0";
        $iat = time();
        $exp = $iat + 3600;

        $payload = array(
            "user_name" => $get_user["user_name"],
            "user_email" => $get_user["user_email"],
            "iat" => $iat,
            "exp" => $exp,
        );
        $token = JWT::encode($payload, $key, 'HS256');

        return $this->response->setJSON([
            "susses" => true,
            "message" => 'Usuario logado',
            "token" => $token
        ]);
    }
    private function generateJWT(array $payload)
    {
        $key = '869f468b932f4dffff7acd140b97421e420d36deb354a8c9e5ee1144685f9de0';
        return JWT::encode($payload, $key, "HS256");
    }
}
