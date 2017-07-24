<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter,
    Symfony\Component\HttpFoundation\Request,
    AppBundle\Entity\Category,
    AppBundle\Type\CategoryType,
    Doctrine\Common\Collections\ArrayCollection,
    AppBundle\RecursiveIterator\CategoryRecursiveIterator;

/**
 * @Route("/category")
 */
class CategoryController extends BaseController {

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
            'categories' => $tableCategories,
            'categoriesCount' => count($categories)
        ];
    }

    /**
     * @Route("/create", name="category_create_root")
     * @Route("/create/{id}", name="category_create")
     * @ParamConverter("parentCategory", class="AppBundle:Category")
     * @Method({"GET", "POST"})
     * @Template("category/form.html.twig")
     * @param Request $request Request
     */
    public function createAction(Request $request, Category $parentCategory = null) {

        $category = new Category();
        $category->setParentId($parentCategory);
        
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash(self::FLASH_SUCCESS, 'front.category.create.success');
            return $this->redirectToRoute('category_home');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/update/{id}", name="category_update")
     * @ParamConverter("category", class="AppBundle:Category")
     * @Method({"GET", "POST"})
     * @Template("category/form.html.twig")
     * @param Request $request Request
     */
    public function updateAction(Request $request, Category $category) {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($category);
            $em->flush();
            
            $this->addFlash(self::FLASH_SUCCESS, 'front.category.update.success');
            return $this->redirectToRoute('category_home');
        }
        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="category_delete")
     * @ParamConverter("category", class="AppBundle:Category")
     * @Method("GET")
     * @param Category $category Entity requested to delete
     */
    public function deleteAction(Category $category) {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($category);
        $em->flush();
        $this->addFlash(self::FLASH_SUCCESS, 'front.category.delete.success');
        return $this->redirectToRoute('category_home');
    }
    
    /**
     * @Route("/teste/", name="category_teste")
     * @Method("GET")
     * @param Category $category Entity requested to delete
     */
    public function testeAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $category = new Category();
        $category->setName('Ciacolor');
        $em->persist($category);
        
        $category2 = new Category();
        $category2->setName('Massa de Nivelamento');
        $category2->setParentId($category);
        
        $category3 = new Category();
        $category3->setName('Tintas');
        $category3->setParentId($category);
        
        $category4 = new Category();
        $category4->setName('Alternativa Eco');
        $em->persist($category4);
        
        $category5 = new Category();
        $category5->setName('Tijolo Ecológico');
        $category5->setParentId($category4);
        
        $category6 = new Category();
        $category6->setName('Pavers');
        $category6->setParentId($category4);
        
        $em->persist($category2);
        $em->persist($category3);
        $em->persist($category5);
        $em->persist($category6);
        
        $em->flush();
        return $this->redirectToRoute('category_home');
    }

}
