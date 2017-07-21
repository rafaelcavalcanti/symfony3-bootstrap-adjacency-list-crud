<?php

namespace AppBundle\Twig\Extension\PHP;

/**
 * Description of StrRepeatExtension
 *
 * @author RAFAEL
 */
class StrRepeat extends \Twig_Extension {

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('str_repeat', array($this, 'strRepeat')),
        );
    }

    public function strRepeat($value, $input, $multiplier) {
        return str_repeat($input, $multiplier) . $value;
    }

}
