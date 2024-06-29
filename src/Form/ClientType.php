<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Credit;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'Prénom'])
            ->add('lastName', TextType::class, ['label' => 'Nom'])
            ->add('addres', TextType::class, ['label' => 'Adresse'])
            ->add('phone', TextType::class, ['label' => 'Numéro de téléphone'])
            ->add('dateBirth', null, [
                'widget' => 'single_text', 'label' => 'Date de naissance'
            ])
            ->add('enable', HiddenType::class, ['label' => 'Activer'])
            ->add('credit', EntityType::class, [
                'class' => Credit::class,
                'choice_label' => 'quantite',
                'disabled' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
