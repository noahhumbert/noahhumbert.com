<?php
// src/Controller/TestController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Attribute\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController {
     #[Route('/test', name: 'test')]
     public function index(): Response {
	     $hello = 'Hello World';

          $session = $request->getSession();

          // Set a value in the session
          $session->set('foo', 'bar');

          // Retrieve the value to confirm persistence
          $foo = $session->get('foo');

          return $this->render('test.html.twig', [
               'hello' => $hello,
               'session_id' => $session->getId(),
               'foo' => $foo,
          ]);
     }
}

?>
