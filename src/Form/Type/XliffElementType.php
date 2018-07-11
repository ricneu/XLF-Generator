<?php

// src/Form/Type/TagType.php
namespace App\Form\Type;

use App\Entity\XliffElement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class XliffElementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('source');
        $builder->add('target');
        $builder->add('id');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        'data_class' => XliffElement::class,
        ));
    }
}