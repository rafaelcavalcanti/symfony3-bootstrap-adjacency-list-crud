<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    AppBundle\Entity\Category,
    AppBundle\Type\CategoryType,
    Doctrine\Common\Collections\ArrayCollection,
    AppBundle\RecursiveIterator\CategoryRecursiveIterator;

/**
 * @Route("/category")
 */
class CategoryController extends Controller {

    /**
     * @Route("/", name="category_home")
     * @Method({"GET"})
     * @Template("category/index.html.twig")
     */
    public function categoryAction(Request $request) {


        $em = $this->getDoctrine()->getManager();
        $categoryRepo = $em->getRepository(Category::class);


        # Solution by:
        # https://wildlyinaccurate.com/simple-nested-sets-in-doctrine-2/
        $categories = $categoryRepo->findBy(array('parentId' => null));
        
        $collection = new ArrayCollection($categories);
        $categoryIterator = new CategoryRecursiveIterator($collection);
        $tableCategories = new \RecursiveIteratorIterator($categoryIterator, \RecursiveIteratorIterator::SELF_FIRST);

        return [
            'categoriesNavbarIterator' => $categoryIterator,
            'categories' => $tableCategories
        ];
    }

    /**
     * @Route("/create/{id}", name="category_create")
     * @Method({"GET", "POST"})
     * @Template("category/form.html.twig")
     * @param Request $request Request
     */
    public function createAction(Request $request) {

        //$form = $this->container->get('app.form.categorytype');
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/update/{id}", name="category_update")
     * @Method({"GET", "POST"})
     * @Template("category/form.html.twig")
     * @param Request $request Request
     */
    public function updateAction(Request $request) {
        
    }

    /**
     * @Route("/delete/{id}", name="category_delete")
     * @Method({"GET", "POST"})
     * @Template("category/form.html.twig")
     * @param Request $request Request
     */
    public function deleteAction(Request $request) {
        
    }

}
