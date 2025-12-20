<?php
// /src/Controller/SignInController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SignInController extends AbstractController {
    #[Route('/signin', name: 'signin')]
    public function index(AuthenticationUtils $authenticationUtils): Response {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        //last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('signin.html.twig'), [
            'controller_name' => 'SignInController',
            'last_username' => $lastUsername,
            'error' => $error,
        ];
    }
}

?>
