<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository,
    Doctrine\Common\Collections\ArrayCollection,
    AppBundle\RecursiveIterator\CategoryRecursiveIterator;

class CategoryRepository extends EntityRepository {

    public function fetchForFormType($space = '&nbsp;&nbsp;') {
        $categories = $this->findBy(array('parentId' => null));
        $collection = new ArrayCollection($categories);
        $categoryIterator = new CategoryRecursiveIterator($collection);
        $recursiveIterator = new \RecursiveIteratorIterator($categoryIterator, \RecursiveIteratorIterator::SELF_FIRST);
        
        $options = array();
        $options['<root>'] = null;
        foreach ($recursiveIterator as $row) {
            $options[sprintf('%s%s', str_repeat($space, $recursiveIterator->getDepth()), $row->getName())] = true;
        }
        return $options;
    }

}
