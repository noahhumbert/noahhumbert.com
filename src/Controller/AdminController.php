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
        $addRoleForm = $this->createForm(AddRoleType::class, null, [
            'attr' => ['id' => 'add_role_form']
        ]);
        $addRoleForm->handleRequest($request);

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
        $removeRoleForm = $this->createForm(RemoveRoleType::class, null, [
            'attr' => ['id' => 'remove_role_form']
        ]);
        $removeRoleForm->handleRequest($request);

        if ($removeRoleForm->isSubmitted() && $removeRoleForm->isValid()) {
            $data  = $removeRoleForm->getData();
            $email = $data['email'];
            $role  = $data['role'];

            $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);

            if (!$user) {
                $this->addFlash('danger', 'User not found.');
                return $this->redirectToRoute('admin');
            }

            // Prevent removing your own admin role
            if ($user === $this->getUser() && $role === 'ROLE_ADMIN') {
                $this->addFlash('warning', 'You cannot remove your own admin role.');
                return $this->redirectToRoute('admin');
            }

            $roles = $user->getRoles();

            // Remove the role if it exists
            if (in_array($role, $roles)) {
                $roles = array_filter($roles, fn($r) => $r !== $role);
            }

            // Ensure at least ROLE_USER
            if (empty($roles)) {
                $roles = ['ROLE_USER'];
            }

            // Reset array keys and force Doctrine to see a change
            $user->setRoles(array_values($roles));

            $em->persist($user); // ensure Doctrine knows this entity is updated
            $em->flush();

            $this->addFlash('success', 'Role removed.');
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin.html.twig', [
            'addRoleForm' => $form->createView(),
            'removeRoleForm' => $form->createView(),
        ]);
    }
}
