<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

class RemoveRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
            ])
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'ROLE_ADMIN'   => 'ROLE_ADMIN',
                    'ROLE_USER'    => 'ROLE_USER',
                ],
                'label' => false,
            ]);
    }
}
