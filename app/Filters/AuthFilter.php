<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Exception;

class AuthFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        $key = '869f468b932f4dffff7acd140b97421e420d36deb354a8c9e5ee1144685f9de0';
        $response = service('response');
        $token = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX25hbWUiOiJ2aXRvcmZlcm5hbmRvIiwidXNlcl9lbWFpbCI6InZpY3RvckBnbWFpbC5jb20ifQ.nPtg3uGWj_EaFyGL0E5XXujpuvyvOVo3rfzZlD3Zkp8";
        $key = "869f468b932f4dffff7acd140b97421e420d36deb354a8c9e5ee1144685f9de0";
        var_dump(JWT::decode($token, $key, ['HS256']));
        die;

        $decodedToken = JWT::decode("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX25hbWUiOiJ2aXRvcmZlcm5hbmRvIiwidXNlcl9lbWFpbCI6InZpY3RvckBnbWFpbC5jb20ifQ.nPtg3uGWj_EaFyGL0E5XXujpuvyvOVo3rfzZlD3Zkp8", '869f468b932f4dffff7acd140b97421e420d36deb354a8c9e5ee1144685f9de0', ['HS256']);
        try {
            $key = '869f468b932f4dffff7acd140b97421e420d36deb354a8c9e5ee1144685f9de0';
            $response = service('response');
            $token = $request->getHeaderLine('Authorization');
            if (empty($token)) {
                return $response->setStatusCode(401)->setJSON(['error' => 'Token JWT não fornecido.']);
            }
            $token = str_replace('Bearer ', '', $token);
            $decodedToken = JWT::decode($token, $key, ['HS256']);
            $agora = time();
            if (isset($decodedToken->exp) && $decodedToken->exp < $agora) {
                return $response->setStatusCode(401)->setJSON(['error' => 'Token JWT expirado.']);
            }
            $request->jwt = $decodedToken;
        } catch (Exception $e) {
            return $response->setStatusCode(401)->setJSON(['error' => 'Token JWT inválido.']);
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
