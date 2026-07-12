<?php
// /src/Controller/MentorshipController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MentorshipController extends AbstractController {
    #[Route('/mentorship', name: 'home')]
    public function mentorship(): Response {
        return $this->render('mentorship.html.twig');
    }
}

?>