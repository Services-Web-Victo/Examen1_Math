<?php

namespace App\Action\Sort;

use App\Domain\Sort\Service\SortUpdate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SortUpdateAction
{
    private $sortUpdate;

    public function __construct(SortUpdate $sortUpdate)
    {
        $this->sortUpdate = $sortUpdate;
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {

        // Récupération du paramètre de route 'id'
        $id = $request->getAttribute('id', 0);
        // Récupération des données du corps de la requête
        $data = (array)$request->getParsedBody();

        $resultat = $this->sortUpdate->modifierSort($id, $data);

        // Construit la réponse HTTP
        $response->getBody()->write((string)json_encode($resultat['reponse']));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($resultat['codeStatut']);
    }
}