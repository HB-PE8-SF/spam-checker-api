<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
class ApiController extends AbstractController
{
    private const SPAM_DOMAINS = ['test.com', 'mailinator.com'];

    #[Route('/check', name: 'check', methods: [Request::METHOD_POST])]
    public function check(Request $request): JsonResponse
    {
        $content = $request->toArray();

        // clé email existe ? Email est valide ?

        ['email' => $email] = $content;

        $emailParts = explode('@', $email);
        [, $domain] = $emailParts;

        if (in_array($domain, self::SPAM_DOMAINS)) {
            $result = 'spam';
        } else {
            $result = 'ok';
        }

        return $this->json([
            'result' => $result
        ]);
    }
}
