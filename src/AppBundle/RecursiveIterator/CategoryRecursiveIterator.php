<?php

namespace AppBundle\RecursiveIterator;

use Doctrine\Common\Collections\Collection;
/**
 * Solution by:
 * @link https://wildlyinaccurate.com/simple-nested-sets-in-doctrine-2/
 * 
 */
class CategoryRecursiveIterator implements \RecursiveIterator {

    private $_data;

    public function __construct(Collection $data) {
        $this->_data = $data;
    }

    public function hasChildren() {
        return (!$this->_data->current()->getChildCategories()->isEmpty());
    }

    public function getChildren() {
        return new CategoryRecursiveIterator($this->_data->current()->getChildCategories());
    }

    public function current() {
        return $this->_data->current();
    }

    public function next() {
        $this->_data->next();
    }

    public function key() {
        return $this->_data->key();
    }

    public function valid() {
        return $this->_data->current() instanceof \AppBundle\Entity\Category;
    }

    public function rewind() {
        $this->_data->first();
    }

}
