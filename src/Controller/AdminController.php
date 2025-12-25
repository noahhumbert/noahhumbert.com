<?php
// /src/Controller/AdminController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController {
    #[Route('/admin', name: 'admin')]
    public function index(): Response {
        return $this->render('admin.html.twig');
    }
}

?>
