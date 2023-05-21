<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Throwable;

class MigrateController extends Controller
{
    public function index()
    {
        $migrate = \Config\Services::migrations();
        $response = service('response');
        try {
            $migrate->latest();
        } catch (Throwable $e) {
            return $response->setStatusCode(401)->setJSON(['error' => 'Token JWT inválido.']);
        }
    }
}
