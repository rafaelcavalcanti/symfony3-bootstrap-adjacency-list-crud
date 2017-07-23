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


        https://stackoverflow.com/questions/41863661/symfony-3-spl-object-hash-expects-parameter-1-to-be-object-integer-given-when-s
        $repo = $this->em->getRepository(Category::class);
        $categories = $repo->fetchForFormType('--');

        //var_dump($categories);
        //$category = new Category();

        $builder->add('name', TextType::class, array(
                    'label' => 'form.label.name',
                    'attr' => array('class' => 'form-control input-lg', 'placeholder' => 'Name of category',
                        'help' => 'O título será apresentado tanto na listagem, quanto requisitada a leitura da publicação.')
                ))
                ->add('parentId', EntityType::class, array(
                    'class' => Category::class,
                    'choice_label' => function($category) {
                        return $category->getName();
                    },
                    //'choices' => $category->getChildCategories(),
                    //
                    'choice_value' => 'id',
                    'label' => 'form.label.categories',
                    'attr' => array('class' => 'form-control input-lg')
                ))
                ->add('submit', SubmitType::class, array(
                    'label' => '<i class="fa fa-circle-o-right"></i> Submit',
                    'attr' => array('class' => 'btn btn-primary')
        ));


        // Add listeners for Post field
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        //$builder->addEventListener(
        //        FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
        // this would be your entity, i.e. Profile
        //    $data = $event->getData();
        //    $formModifier($event->getForm(), $data->getLocationCountry());
        //}
        //);
    }

    public function onPreSetData(FormEvent $event) {
        /** @var User user */
        $category = $event->getData();
        $form = $event->getForm();

        $this->addElements($form, $category->getChildCategories());
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Category::class,
        ));
    }

}
