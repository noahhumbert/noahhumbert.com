<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AddRoleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function admin(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $form = $this->createForm(AddRoleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data  = $form->getData();
            $email = $data['email'];
            $role  = $data['role'];

            /** @var User|null $user */
            $user = $em->getRepository(User::class)->findOneBy([
                'email' => $email
            ]);

            if (!$user) {
                $this->addFlash('danger', 'User not found.');
            } else {
                $roles   = $user->getRoles();
                $roles[] = $role;

                $user->setRoles(array_unique($roles));
                $em->flush();

                $this->addFlash('success', 'Role added successfully.');
            }

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin.html.twig', [
            'addRoleForm' => $form->createView(),
        ]);
    }
}
