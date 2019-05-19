<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class ProductType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();

        dump($user->getRoles());

        if ($user->getRoles()[0] == "ROLE_ADMIN")
        {
            $builder
                ->add('name')
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'title'
                ])
                ->add('description')
                ->add('barCode')
                ->add('localisation')
            ;
        }

        else {
            $builder
                ->add('name', null, [
                    'label' => 'Nom',
                    'attr' => [
                        'placeholder' => 'Nom du produit',
                        'disabled' => 'disabled'
                    ]
                ])
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'title',
                    'label' => 'Catégorie',
                    'attr' => [
                        'disabled' => 'disabled'
                    ]
                ])
                ->add('description', null, [
                    'label' => 'Description',
                    'attr' => [
                        'placeholder' => 'Description du produit',
                        'disabled' => 'disabled'
                    ]
                ])
                ->add('barCode', null, [
                    'label' => 'Code barre',
                    'attr' => [
                        'placeholder' => 'Code barre du produit',
                        'disabled' => 'disabled'
                    ]
                ])
                ->add('localisation', null, [
                    'label' => 'Localisation',
                    'attr' => [
                        'placeholder' => 'Localisation du produit',
                        'disabled' => 'disabled'
                    ]
                ])
            ;         
        }

        $builder
            ->add('stock', null, [
                'label' => 'Stock',
                'attr' => [
                    'placeholder' => 'Stock'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
