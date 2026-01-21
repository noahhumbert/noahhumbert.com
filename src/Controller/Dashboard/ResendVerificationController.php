<?php
// /src/Controller/DashboardController.php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

#[Route('/dashboard/resend', name: 'resend_email')]
public function resendVerificationEmail(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
{
    /** @var User $user */
    $user = $this->getUser();

    if (!$user) {
        $this->addFlash('error', 'You must be logged in to verify your email.');
        return $this->redirectToRoute('login');
    }

    if ($user->isVerified()) {
        $this->addFlash('success', 'Your email is already verified.');
        return $this->redirectToRoute('dashboard');
    }

    // Send the verification email
    $this->emailVerifier->sendEmailConfirmation(
        'resend_email',
        $user,
        (new TemplatedEmail())
            ->from(new Address('noreply@noahhumbert.com', 'No Reply'))
            ->to($user->getEmail())
            ->subject('Please Confirm Your Email')
            ->htmlTemplate('registration/confirmation_email.html.twig')
    );

    $this->addFlash('success', 'A new verification email has been sent.');

    return $this->redirectToRoute('dashboard');
}

?>