<?php

namespace Remg\LayoutBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatepickerTypeExtension extends AbstractTypeExtension
{
    public function getExtendedType()
    {
        return DateTimeType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('datepicker', false);
    }
 
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['datepicker'] = $options['datepicker'];
    }
}