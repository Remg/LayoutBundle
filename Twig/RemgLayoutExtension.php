<?php

namespace Remg\LayoutBundle\Twig;

use Twig_Environment;
use Twig_Extension;
use Twig_SimpleFilter;
use DateTime;

class RemgLayoutExtension extends Twig_Extension
{
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('age', [$this, 'getAgeFromDate']),
            new Twig_SimpleFilter('boolean', [$this, 'renderBoolean'], ['is_safe' => array('html'), 'needs_environment' => true]),
            new Twig_SimpleFilter('fullDate', [$this, 'renderFullDate'], ['is_safe' => array('html'), 'needs_environment' => true]),
        ];
    }

    public function getAgeFromDate(DateTime $date)
    {
        $now = new DateTime('today');

        return  $date->diff($now)->y;
    }

    public function renderBoolean(Twig_Environment $env, $boolean)
    {
        return $env->render("RemgLayoutBundle:admin:widget/boolean.html.twig", ['boolean' => (bool) $boolean]);
    }

    public function renderFullDate(Twig_Environment $env, $date)
    {
        return $env->render("RemgLayoutBundle:admin:widget/date.html.twig", ['date' => $date]);
    }

    public function getName()
    {
        return 'remg_layout.extension';
    }
}