<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AddRoleType;
use App\Form\RemoveRoleType;
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
        /** ADD ROLE FORM */
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

        /** REMOVE ROLE FORM */
        $removeRoleForm = $this->createForm(RemoveRoleType::class);
        $removeRoleForm->handleRequest($request);

        if ($removeRoleForm->isSubmitted() && $removeRoleForm->isValid()) {
            $data  = $removeRoleForm->getData();
            $email = $data['email'];
            $role  = $data['role'];

            $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                $roles = array_diff($user->getRoles(), [$role]);

                // Symfony requires ROLE_USER at minimum
                if (empty($roles)) {
                    $roles = ['ROLE_USER'];
                }

                $user->setRoles($roles);
                $em->flush();

                $this->addFlash('success', 'Role removed.');
            } else {
                $this->addFlash('danger', 'User not found.');
            }

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin.html.twig', [
            'addRoleForm' => $form->createView(),
            'removeRoleForm' => $form->createView(),
        ]);
    }
}
