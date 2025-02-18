<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Controller\GenericCategoryController;

#[ApiResource]
#[Get(
    name: 'get_generic_categories',
    uriTemplate: '/categories/{domain}',
    controller: GenericCategoryController::class
)]
class Category {}
