<?php

function error(int $status_code, string $message): void
{
    $response = service('response');
    $response->setStatusCode($status_code)->setJSON([
        'error' => true,
        'message' => $message,
    ]);
    die;
}
