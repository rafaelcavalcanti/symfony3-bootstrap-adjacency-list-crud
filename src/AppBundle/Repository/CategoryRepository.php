<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository,
    Doctrine\Common\Collections\ArrayCollection,
    AppBundle\RecursiveIterator\CategoryRecursiveIterator;

class CategoryRepository extends EntityRepository {

    
    
    public function fetchCategories(array $criteria) {

        # Solution by:
        # https://wildlyinaccurate.com/simple-nested-sets-in-doctrine-2/
        $root_categories = $this->findBy($criteria);
        $collection = new ArrayCollection($root_categories);
        $category_iterator = new CategoryRecursiveIterator($collection);
        $categories = new \RecursiveIteratorIterator($category_iterator, \RecursiveIteratorIterator::SELF_FIRST);
        return $categories;
    }

}
