<?php
// /src/Controller/BusinessCardController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BusinessCardController extends AbstractController {
    #[Route('/business-card', name: 'business-card')]
    public function business_card(): Response {
        return $this->render('business-card.html.twig');
    }
}

?>
