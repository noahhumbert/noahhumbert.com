<?php
// /src/Controller/WebsiteProjectController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebsiteProjectController extends AbstractController {
    #[Route('/projects/my-website', name: 'my-website')]
    public function index(): Response {
        return $this->render('projects/nhwebsite.html.twig');
    }
}

?>
