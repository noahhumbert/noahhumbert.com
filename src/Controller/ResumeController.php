<?php
// /src/Controller/ResumeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResumeController extends AbstractController {
    #[Route('/resume', name: 'resume')]
    public function resume(): Response {
        return $this->render('resume.html.twig');
    }
}

?>
