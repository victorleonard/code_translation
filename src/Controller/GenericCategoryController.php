<?php

namespace App\Controller;

use App\Config\SupportedDomains;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GenericCategoryController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(string $domain): JsonResponse
    {
        // Vérifier si le domaine est supporté
        if (!array_key_exists($domain, SupportedDomains::DOMAINS)) {
            throw new NotFoundHttpException(sprintf('Domain "%s" is not supported.', $domain));
        }

        // Récupérer l'entité associée au domaine
        $entityClass = SupportedDomains::DOMAINS[$domain];

        // Requête pour récupérer les catégories uniques
        $categories = $this->entityManager
            ->createQuery(sprintf('SELECT DISTINCT e.category FROM %s e', $entityClass))
            ->getResult();

        $categories = array_map(static fn($item) => $item['category'], $categories);

        return new JsonResponse($categories);
    }
}
