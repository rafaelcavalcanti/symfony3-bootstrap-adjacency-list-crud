<?php

namespace AppBundle\Twig\Extension\Category;

/**
 * Description of StrRepeatExtension
 *
 * @author RAFAEL
 */
class Navbar extends \Twig_Extension {

    public function getFunctions() {
        return [
            new \Twig_SimpleFunction('category_navbar', array($this, 'Navbar'))
        ];
    }

    public function Navbar($menu) {

        
        // Ordem
        
        $navbar = null;
        foreach ($menu as $row) {
            $menu->getDepth();
            $navbar .= sprintf('<li><a href="%s" title="%s">%s</a></li>', '#', $row->getName(), $row->getName());
        }
        
        return sprintf('<ul class="nav navbar-nav navbar-right">%s</ul>', $navbar);
    }

}
