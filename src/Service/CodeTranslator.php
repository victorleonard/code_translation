<?php

namespace App\Service;

use App\Config\SupportedDomains;
use Doctrine\ORM\EntityManagerInterface;

class CodeTranslator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Traduire un code pour un domaine spécifique.
     *
     * @param string $domain Le domaine (ex. : "airline", "hotel", etc.)
     * @param string $code Le code à traduire
     * @param string|null $category La catégorie optionnelle (ex. : "IATA", "CLASS")
     * @return string|null La description du code, ou null si non trouvé
     */
    public function translate(string $domain, string $code, ?string $category = null): ?string
    {
        $repository = $this->entityManager->getRepository($this->getEntityClass($domain));

        $criteria = ['code' => $code];
        if ($category) {
            $criteria['category'] = $category;
        }

        $translation = $repository->findOneBy($criteria);

        return $translation ? $translation->getDescription() : null;
    }

    /**
     * Obtenir la classe d'entité pour un domaine donné.
     */
    private function getEntityClass(string $domain): string
    {
        if (!array_key_exists($domain, SupportedDomains::DOMAINS)) {
            throw new \InvalidArgumentException("Domaine non pris en charge : $domain");
        }

        return SupportedDomains::DOMAINS[$domain];
    }
}
