<?php

namespace AppBundle\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\Extension\Core\Type\TextType,
    Symfony\Component\Form\Extension\Core\Type\ChoiceType,
    Symfony\Bridge\Doctrine\Form\Type\EntityType,
    Symfony\Component\Form\Extension\Core\Type\SubmitType,
    Symfony\Component\OptionsResolver\OptionsResolver,
    Symfony\Component\Form\FormEvent,
    Symfony\Component\Form\FormEvents,
    AppBundle\Entity\Category,
    AppBundle\Repository\CategoryRepository,
    Doctrine\ORM\EntityManagerInterface,
    AppBundle\Type\AdjacencyTreeType;

class CategoryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('name', TextType::class, [
                    'label' => 'form.category.label.name',
                    'attr' => [
                        'class' => 'form-control input-lg', 'placeholder' => 'form.category.placeholder.name',
                        'help' => ''
                    ]
                ])
                ->add('parent', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => function($category) {
                        return str_repeat('--', $category->getTreeLevel()) . $category->getName();
                    },
                    'required' => false,
                    'placeholder' => 'from.category.parent.null.value',
                    'label' => 'form.label.categories',
                    'attr' => [
                        'class' => 'form-control input-lg',
                        'help' => ''
                    ]
                ])
                ->add('submit', SubmitType::class, [
                    'label' => '<i class="fa fa-circle-o-right"></i> Submit',
                    'attr' => ['class' => 'btn btn-primary']
        ]);

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Category::class,
        ));
    }

}
