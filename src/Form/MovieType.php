<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\MovieStock;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('Summary')
            ->add('DateSortie', null, [
                'widget' => 'single_text',
            ])
            ->add('Enable')
            ->add('movieStock', EntityType::class, [
                'class' => MovieStock::class, 
                'choice_label' => 'id',
            ])
            
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
'choice_label' => 'name',
'multiple' => true,
            ])
            ->add('medias', CollectionType::class, [
                'entry_type' => MediaType::class,
                'by_reference'=> false,
                'allow_add' => true,
                'allow_delete' => true,
                'entry_options' => ['label'=> false],
                'attr' =>[
                    'data-controller' => 'form-collection',
                    'data-form-collection-add-label-value' => 'Ajouter un média',
                    'data-form-collection-delete-label-value' => 'Suprimer un média',
                ]
            ])
            ->add('save', SubmitType::class,['label'=> 'envoyer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
