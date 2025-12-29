<?php
// /src/Controller/EBitBreadboardController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EBitBreadboardController extends AbstractController {
    #[Route('/projects/breadboardcomputer', name: 'breadboardcomputer')]
    public function index(): Response {
        return $this->render('projects/breadboardcomputer.html.twig');
    }
}

?>
