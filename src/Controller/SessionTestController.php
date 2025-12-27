<?php
// /src/Controller/SessionTestController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/session-test', name: 'session_test')]
public function sessionTest(Request $request): Response
{
    $session = $request->getSession();
    $session->set('foo', 'bar');

    return new Response('Session ID: '.$session->getId().' | Foo: '.$session->get('foo'));
}

?>
