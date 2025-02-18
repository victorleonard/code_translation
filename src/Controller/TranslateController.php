<?php

namespace App\Controller;

use App\Service\CodeTranslator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TranslateController
{
    public function __construct(private CodeTranslator $codeTranslator) {}

    #[Route('/api/translate', name: 'api_translate', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $domain = $request->query->get('domain');
        $code = $request->query->get('code');
        $category = $request->query->get('category');

        if (!$domain || !$code || !$category) {
            return new JsonResponse(['error' => 'Missing required parameters'], JsonResponse::HTTP_BAD_REQUEST);
        }

        try {
            $result = $this->codeTranslator->translate($domain, $code, $category);
            if (!$result) {
                return new JsonResponse(['error' => 'No translation found'], JsonResponse::HTTP_NOT_FOUND);
            }

            return new JsonResponse($result);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
