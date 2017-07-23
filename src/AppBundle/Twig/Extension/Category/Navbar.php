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
    
    
    public function Navbar(\RecursiveIterator $iterator) {
        
        $navbar = null;
        while($iterator->valid()) {
            if ($iterator->hasChildren()) {
                $current = $iterator->current();
                $navbar .= '<li class="dropdown">';
                $navbar .= sprintf('<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">%s<span class="caret"></span></a>', $current->getName());
                $navbar .= '<ul class="dropdown-menu">';
                $navbar .= $this->Navbar($iterator->getChildren());
                $navbar .= '</ul></li>';
            } else {
                $current = $iterator->current();
                $navbar .= sprintf('<li><a href="%s" title="%s">%s</a></li>', '#', $current->getName(), $current->getName());
            } 
            $iterator->next();
        }
        return $navbar;
    }

}
