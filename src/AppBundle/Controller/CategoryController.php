<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    AppBundle\Entity\Category,
    AppBundle\Type\CategoryType;


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
        $categories = $categoryRepo->fetchCategories(array('parentId' => null));
     
        return [
            'categories' => $categories
        ];
    }

    /**
     * @Route("/create/{id}", name="category_create")
     * @Method({"GET", "POST"})
     * @Template("category/form.html.twig")
     * @param Request $request Request
     */
    public function createAction(Request $request) {
        
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
