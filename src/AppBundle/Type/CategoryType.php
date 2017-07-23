<?php

namespace AppBundle\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\Extension\Core\Type\TextType,
    Symfony\Component\Form\Extension\Core\Type\ChoiceType,
    Symfony\Bridge\Doctrine\Form\Type\EntityType,
    Symfony\Component\Form\Extension\Core\Type\SubmitType,
    Symfony\Component\OptionsResolver\OptionsResolver,
    AppBundle\Entity\Category,
    AppBundle\Repository\CategoryRepository,
    Doctrine\ORM\EntityManagerInterface;

class CategoryType extends AbstractType {
    
    /**
     *
     * @var EntityManager
     */
    private $em;
    
    /**
     * 
     * @param EntityManager $em
     */
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $repo = $this->em->getRepository(Category::class);
        $categories = $repo->fetchForFormType('--');

        $builder->add('name', TextType::class, array(
                    'label' => 'form.label.name',
                    'attr' => array('class' => 'form-control input-lg', 'placeholder' => 'Name of category',
                        'help' => 'O título será apresentado tanto na listagem, quanto requisitada a leitura da publicação.')
                ))
                ->add('parentId', ChoiceType::class, array(
                    'label' => 'form.label.categories',
                    'choices' => $categories,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('submit', SubmitType::class, array(
                    'label' => '<i class="fa fa-circle-o-right"></i> Submit',
                    'attr' => array('class' => 'btn btn-primary')
        ));

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Category::class,
        ));
    }

}
