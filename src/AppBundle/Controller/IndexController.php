<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of IndexController
 *
 * @author RAFAEL
 */
class IndexController extends Controller {

    /**
     * @Route("/", name="app_home")
     * @Method({"GET"})
     */
    public function indexAction() {
        return $this->redirectToRoute('category_home');
    }

}
