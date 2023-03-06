<?php

use Slim\App;

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class);

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    // Écoles de magie
    $app->get('/ecoles', \App\Action\Ecole\EcoleViewAction::class);

    // Sorts
    $app->put('/sorts/{id}', \App\Action\Sort\SortUpdateAction::class);
    $app->get('/sorts/{classe}', \App\Action\Sort\SortViewAction::class);

};

