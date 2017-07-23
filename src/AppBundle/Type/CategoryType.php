<?php

namespace AppBundle\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\Extension\Core\Type\TextType,
    Symfony\Bridge\Doctrine\Form\Type\EntityType,
    Symfony\Component\Form\Extension\Core\Type\SubmitType,
    Symfony\Component\OptionsResolver\OptionsResolver,
    AppBundle\Entity\Categorias;

class CategoriaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('titulo', TextType::class, array(
                    'attr' => array('class' => 'form-control input-lg', 'placeholder' => 'Seu título',
                        'help' => 'O título será apresentado tanto na listagem, quanto requisitada a leitura da publicação.')
                ))
                /*->add('categoria', EntityType::class, array(
                    'class' => 'AECOSiteBundle:BlogCategoria',
                    'choice_label' => 'nome',
                    'query_builder' => function (CategoriasRepository $er) {
                        $qb = $er->createQueryBuilder('c');
                        $qb->andWhere($qb->expr()->eq('c.ativo', '1'));
                        return $qb;
                    },
                    'attr' => array('class' => 'form-control')
                ))*/
                ->add('publicar', SubmitType::class, array(
                    'label' => '<i class="fa fa-edit"></i> Publicar',
                    'attr' => array('class' => 'btn btn-primary')
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Categorias::class,
        ));
    }

}
