<?php

namespace App\Form;

use App\Entity\Client;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class RegistrationClientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('firstName', TextType::class, ['label' => 'Prénom'])
            ->add('lastName', TextType::class, ['label' => 'Nom'])
            ->add('addres', TextType::class, ['label' => 'Adresse'])
            ->add('phone', TelType::class, ['label' => 'Numéro de téléphone'])
            ->add('dateBirth', null, [
                'widget' => 'single_text', 'label' => 'Date de naissance'
            ])
            ->add('enable', HiddenType::class, ['label' => 'Activer'])

            ->add('user', RegistrationFormType::class, ['label' => ' '])

            ->add('save', SubmitType::class, ['label' => 'Enregister', 'attr' => ['class' => 'btn btn-blue btn-blue:hover']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
