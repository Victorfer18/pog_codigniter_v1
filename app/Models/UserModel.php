<?php


namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class UserModel extends Model
{
    private $banco;
    public function __construct()
    {
        $this->banco = \Config\Database::connect();
    }
    public function registerUser(
        string $user_name,
        string $user_email,
        string $user_password
    ): void {
        $table = $this->banco->table('users');
        $table->insert([
            "id" => new RawSql('DEFAULT'),
            "user_name" => $user_name,
            "user_email" => $user_email,
            "user_password" => password_hash($user_password, PASSWORD_DEFAULT),
            "created_at" => new RawSql('CURRENT_TIMESTAMP()'),
            "updated_at" => new RawSql('CURRENT_TIMESTAMP()')
        ]);
    }
    public function searchUser_by_name(string $user_name): array
    {
        $table = $this->banco->table('users');
        $get_user = $table->where("user_name", $user_name)->get()->getResultArray();
        return $get_user ?? [];
    }
    public function searchUser_by_email(string $user_email): array
    {
        $table = $this->banco->table('users');
        $get_user = $table->where("user_email", $user_email)->get()->getResultArray();
        return $get_user ?? [];
    }
    public function existUser(string $user_email): bool
    {
        $table = $this->banco->table('users');
        $get_user = $table->where("user_email", $user_email)->get()->getResultArray();
        return !empty($get_user);
    }
    public function login(string $user_email, string $user_password): array
    {
        $table = $this->banco->table('users');
        $get_user_by_email = $table->where('user_email', $user_email)->get()->getResultArray()[0];
        if ($get_user_by_email and password_verify($user_password, $get_user_by_email["user_password"])) {
            return $get_user_by_email;
        }
        return [];
    }
    public function updateUser(int $id, string $user_name, string $user_email): void
    {
        $table = $this->banco->table("users");
        $table->where("id", $id);
        $table->update([
            "user_name" => $user_name,
            "user_email" => $user_email,
            "updated_at" => new RawSql('CURRENT_TIMESTAMP()')
        ]);
    }
    public function getUser_by_id(int $id): array
    {
        $table = $this->banco->table("users");
        return $table->where("id", $id)->get()->getResultArray()[0] ?? [];
    }
}
