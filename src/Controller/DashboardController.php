<?php
// /src/Controller/DashboardController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController {
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response {
        return $this->render('dashboard.html.twig');
    }
}

?>