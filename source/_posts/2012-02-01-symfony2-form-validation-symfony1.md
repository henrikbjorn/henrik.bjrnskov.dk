---
layout: post
title: 'Symfony2: Using the validator symfony1 style'
---

Two of the more complicated components in Symfony2 is the Form and Validator component. The Validator is created in such a way it "always" need an Domain Object with Constraints associated through metadata. This is explained in detail here [http://symfony.com/doc/2.0/book/validation.html](http://symfony.com/doc/2.0/book/validation.html)

But there is another way. A way that resemble's the symfony1 forms. Where you could specify the validations directly in your form class.

The `FormTypeInterface::getDefaultOptions(array $options)` have an option called `validation_constraint` which together with `Constraints\Collection` can be used to validate the form data.

An example is always better than a 1000 words (well most of the time) so here is a full blown example of a `SessionType`.

``` php
<?php

namespace Foobar\BarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Choice;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class SessionType extends AbstractType
{
    /**
     * @param FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('_username', 'text')
            ->add('_password', 'password')
            ->add('_remember_me', 'checkbox')
        ;
    }

    /**
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'intention' => 'authenticate',
            'validation_constraint' => new Collection(array(
                'fields' => array(
                    '_username' => array(
                        new NotBlank(),
                        new Email(),
                    ),
                    '_password' => new NotBlank(),
                    '_remember_me' => new Choice(array(
                        'choices' => array(
                            true,
                            false,
                        ),
                    )),
                ),
            )),
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'session';
    }
}
```
