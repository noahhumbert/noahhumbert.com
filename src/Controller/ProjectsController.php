<?php
// /src/Controller/ProjectsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectsController extends AbstractController {
    #[Route('/projects', name: 'projects')]
    public function projects(): Response {
        return $this->render('projects.html.twig');
    }
}

?>
