<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Credit;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('LastName')
            ->add('Addres')
            ->add('Phone')
            ->add('FirstName')
            ->add('DateBirth', null, [
                'widget' => 'single_text',
            ])
            ->add('ValideEmail')
            ->add('Enable')
            ->add('credit', EntityType::class, [
                'class' => Credit::class,
'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => Utilisateur::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
