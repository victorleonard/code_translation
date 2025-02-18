<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\OpenApi\Model;
use App\Controller\TranslateController;

#[ApiResource]
#[Get(
    name: 'translate',
    uriTemplate: 'translate',
    controller: TranslateController::class,
    openapi: new Model\Operation(
        summary: 'Translate a code based on domain, code, and category',
        description: 'This endpoint translates a code for a specific domain (like airline, hotel, etc.) using the given code and category.',
        parameters: [
            new Model\Parameter(
                name: 'domain',
                in: 'query',
                description: 'The domain of translation (e.g., airline, hotel)',
                required: true,
                schema: []
            ),
            new Model\Parameter(
                name: 'code',
                in: 'query',
                description: 'The code to translate (e.g., IATA code, room type code)',
                required: true,
                schema: []
            ),
            new Model\Parameter(
                name: 'category',
                in: 'query',
                description: 'The category of the code (e.g., IATA)',
                required: true,
                schema: []
            )
        ]
    )
)]
class Translation
{
    // La classe peut être laissée vide, car l'API expose la logique via le contrôleur
    // Le contrôleur gère la logique pour cette ressource
}
