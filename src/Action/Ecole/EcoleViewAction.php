<?php

namespace App\Action\Ecole;

use App\Domain\Ecole\Service\EcoleView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class EcoleViewAction
{
    private $ecoleView;

    public function __construct(EcoleView $ecoleView)
    {
        $this->ecoleView = $ecoleView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        $resultat = $this->ecoleView->viewEcole();

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}