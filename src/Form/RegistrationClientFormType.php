<?php

namespace App\Form;

use App\Entity\Client;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationClientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('FirstName')
            ->add('LastName')
            ->add('Addres')
            ->add('Phone')
            ->add('DateBirth', null, [
                'widget' => 'single_text',
            ])
            ->add('ValideEmail')
            ->add('Enable', null, ['value' => true, 'label' => 'Activer'])

            ->add('user', RegistrationFormType::class, ['label' => 'Enregister'])
            ->add('save', SubmitType::class, ['label' => 'Enregister']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
