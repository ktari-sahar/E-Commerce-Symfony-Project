<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Commande;
use App\Entity\Detailcommande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailcommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('article', EntityType::class, [
            'class' => Article::class,
            'choice_label' => 'id',
        ])
            ->add('qte')
            ->add('prix')
            ->add('commande', EntityType::class, [
                'class' => Commande::class,
                'choice_label' => 'id',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Detailcommande::class,
        ]);
    }
}
