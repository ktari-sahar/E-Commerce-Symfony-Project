<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Detailfacture;
use App\Entity\Facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailfactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('facture', EntityType::class, [
            'class' => Facture::class,
            'choice_label' => 'id',
        ])
        
        ->add('article', EntityType::class, [
            'class' => Article::class,
            'choice_label' => 'nom',
            'expanded'=>false,
            'attr' => ['class' => 'select2'],
        ])
            ->add('qte')
            ->add('prix')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Detailfacture::class,
        ]);
    }
}
