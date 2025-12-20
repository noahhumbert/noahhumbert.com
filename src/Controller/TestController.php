<?php
// src/Controller/TestController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController {
     #[Route('/test', name: 'test')]
     public function index(): Response {
	     $hello = 'Hello World';

          return $this->render('test.html.twig', [
               'hello' => $hello,
          ]);
     }
}

?>
