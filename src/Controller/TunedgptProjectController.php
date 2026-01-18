<?php
// /src/Controller/TunedgptProjectController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TunedgptProjectController extends AbstractController {
    #[Route('/projects/tunedgpt', name: 'tunedgpt')]
    public function index(): Response {
        return $this->render('projects/tunedgpt.html.twig');
    }
}

?>
