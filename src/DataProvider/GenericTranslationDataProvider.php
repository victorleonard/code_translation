<?php

namespace App\DataProvider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Service\CodeTranslator;
use Doctrine\Common\Util\ClassUtils;

class GenericTranslationDataProvider implements ProviderInterface
{
    private ProviderInterface $decorated;
    private CodeTranslator $codeTranslator;

    public function __construct(ProviderInterface $decorated, CodeTranslator $codeTranslator)
    {
        $this->decorated = $decorated;
        $this->codeTranslator = $codeTranslator;
    }

    /**
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * 
     * @return iterable|object|null
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): iterable|object|null
    {
        // Appeler le Data Provider existant pour récupérer les données
        $data = $this->decorated->provide($operation, $uriVariables, $context);
        dd($data);

        // Appliquer la logique si les données sont des entités
        if (is_iterable($data)) {
            foreach ($data as $item) {
                $this->applyTranslationIfNeeded($item);
            }
        } else {
            $this->applyTranslationIfNeeded($data);
        }

        return $data;
    }

    private function applyTranslationIfNeeded($entity): void
    {
        // Vérifier si l'entité implémente une interface spécifique ou correspond à certaines classes
        if ($entity instanceof \App\Entity\TranslatableInterface) {
            $this->applyTranslation($entity);
        }
    }

    private function applyTranslation($entity): void
    {
        // Extraire les données nécessaires (par exemple : code et catégorie)
        $code = $entity->getCode();
        $category = $entity->getCategory();

        // Appeler le service CodeTranslator
        $translatedDescription = $this->codeTranslator->translate(
            ClassUtils::getClass($entity),
            $code,
            $category
        );

        // Appliquer la traduction si elle existe
        if ($translatedDescription) {
            $entity->setDescription($translatedDescription);
        }
    }
}
