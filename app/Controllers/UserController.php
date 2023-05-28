<?php

namespace App\Controllers;

use App\Models\UserModel;

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
            return $this->validationErrorResponse();
        };
        $user_name = strval($this->request->getPost("user_name"));
        $user_email = strval($this->request->getPost("user_email"));
        $user_password = strval($this->request->getPost("user_password"));
        $UserModel = new UserModel();
        if (!empty($UserModel->searchUser_by_name($user_name))) {
            return $this->errorResponse('Usuario ja existe');
        }
        if (!empty($UserModel->searchUser_by_email($user_email))) {
            return $this->errorResponse('Email ja utilizado');
        }
        $UserModel->registerUser(
            $user_name,
            $user_email,
            $user_password
        );
        return $this->successResponse("Usuario registrado");
    }
    public function update_user()
    {
        $fields = [
            "id" => "required",
            "user_name" => "required",
            "user_email" => "required|valid_email",
        ];
        if (!$this->validate($fields)) {
            return $this->validationErrorResponse();
        };
        $id = intval($this->request->getPost("id"));
        $user_name = strval($this->request->getPost("user_name"));
        $user_email = strval($this->request->getPost("user_email"));
        $UserModel = new UserModel();
        if (empty($UserModel->getUser_by_id($id))) {
            $UserModel->getUser_by_id($id);
            return $this->errorResponse('Usuario nao existe');
        }
        $UserModel->updateUser($id, $user_name, $user_email);
        return $this->successResponse("Usuario atualizado");
    }
    public function get_user_by_id()
    {
        $fields = [
            "id" => "required",
        ];
        if (!$this->validate($fields)) {
            return $this->validationErrorResponse();
        };
        $id = intval($this->request->getGet("id"));
        $UserModel = new UserModel();
        $get_user = $UserModel->getUser_by_id($id);
        if (empty($get_user)) {
            return $this->errorResponse('Usuario nao existe');
        }
        $get_user = [
            "user_name" => $get_user["user_name"],
            "user_email" => $get_user["user_email"],
            "created_at" => $get_user["created_at"],
        ];
        return $this->successResponse("Usuario $get_user[user_name]", $get_user);
    }
    public function get_all_users()
    {
        $UserModel = new UserModel();
        $get_user = $UserModel->getallUser();
        $get_user = array_map(function ($index) {
            return [
                "user_name" => $index["user_name"],
                "user_email" => $index["user_email"],
                "created_at" => $index["created_at"],
            ];
        }, $get_user);
        return $this->successResponse("Todos usuarios", $get_user);
    }
    public function delete_user_by_id()
    {
        $fields = [
            "id" => "required",
        ];
        if (!$this->validate($fields)) {
            return $this->validationErrorResponse();
        };
        $id = intval($this->request->getPost("id"));
        $UserModel = new UserModel();
        $get_user = $UserModel->getUser_by_id($id);
        if (empty($get_user)) {
            return $this->errorResponse('Usuario nao existe');
        }
        $UserModel->deleteUser_by_id($id);
        return $this->successResponse("Usuario '$get_user[user_name]' excluido", $get_user);
    }
}
