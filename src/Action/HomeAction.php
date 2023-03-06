<?php

namespace App\Action;

use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HomeAction
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        
        $result = json_encode([
            'message' => "Services Web H2023 - Examen 01 - Maintenant c'est du sérieux"
        ]);
        
        $response->getBody()->write($result);

        return $response->withHeader('Content-Type', 'application/json');

    }
}
