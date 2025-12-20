<?php
// /src/Controller/SocialsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SocialsController extends AbstractController {
    #[Route('/socials', name: 'socials')]
    public function index(): Response {
        return $this->render('socials.html.twig');
    }
}

?>
