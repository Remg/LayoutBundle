<?php

namespace Remg\LayoutBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class DatePickerType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'icon'       => 'calendar',
            'widget'     => 'single_text',
            'datepicker' => true,
        ]);
    }

    public function getParent()
    {
        return DateTimeType::class;
    }
}