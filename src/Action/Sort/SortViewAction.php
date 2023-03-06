<?php

namespace App\Action\Sort;

use App\Domain\Sort\Service\SortView;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SortViewAction
{
    private $sortView;

    public function __construct(SortView $sortView)
    {
        $this->sortView = $sortView;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération du paramètre de route 'id'
        $classe = $request->getAttribute('classe', '');
        // Récupération des paramètres dans un tableau
        $queryParams = $request->getQueryParams() ?? [];
        // Récupération de la valeur du paramètre page
        $niveau = is_numeric($queryParams['niveau']) ? $queryParams['niveau'] : -1;

        $resultat = $this->sortView->afficherSort($classe, $niveau);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}