<?php
// src/Controller/Api/UserRoleController.php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class UserRoleController extends AbstractController
{
    #[Route('/api/check-role', name: 'api_check_role', methods:['POST'])]
    public function checkRole(Request $request, UserRepository $userRepository): JsonResponse
    {
        // --- TOKEN CHECK ---
        $token = $request->headers->get('X-API-TOKEN'); // header stays the same
        if ($token !== $_ENV['PULL_USER_TOKEN']) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        // --- PARSE REQUEST ---
        $data = json_decode($request->getContent(), true);
        $userId = $data['user_id'] ?? null;
        $role = $data['role'] ?? null;

        if (!$userId || !$role) {
            return $this->json(['error' => 'Missing parameters'], 400);
        }

        // --- FETCH USER BY EMAIL ---
        $user = $userRepository->findOneBy(['email' => $email]);
        if (!$user) {
            return $this->json(['error' => 'User not found'], 404);
        }

        // --- CHECK ROLE ---
        $hasRole = in_array($role, $user->getRoles());

        return $this->json(['has_role' => $hasRole]);
    }
}
?>