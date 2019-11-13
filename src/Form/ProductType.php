<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Model;
use App\Entity\Product;
use App\Entity\Rate;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label')
            ->add('isReservable')
            ->add('isMan')
            ->add('isWoman')
            ->add('isChild')
            ->add('isElectric')
            ->add('isActive')
            ->add('idRate',EntityType::class,[
                'class'=>Rate::class,
                'choice_label'=>'price'
            ])
            ->add('idModel',EntityType::class,[
                'class'=>Model::class,
                'choice_label'=>'label'
            ])
            ->add('idCategory',EntityType::class,[
                'class'=>Category::class,
                'choice_label'=>'label'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
