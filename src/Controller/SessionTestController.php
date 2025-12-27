<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionTestController extends AbstractController
{
    #[Route('/session-test', name: 'session_test')]
    public function sessionTest(Request $request): Response
    {
        $session = $request->getSession();

        // Set a value in the session
        $session->set('foo', 'bar');

        // Retrieve the value to confirm persistence
        $foo = $session->get('foo');

        // Return the session ID and the value
        return new Response('Session ID: '.$session->getId().' | Foo: '.$foo);
    }
}
