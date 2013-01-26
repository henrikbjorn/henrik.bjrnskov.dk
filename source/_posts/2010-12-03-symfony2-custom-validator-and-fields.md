---
layout: post
title: 'Symfony2: Custom validator and fields'
permalink: symfony2-custom-validator-and-fields
---

In Symfony2 there is a new Form and Validator component that are now completly seperate and have been
rewritten from scratch. This also means we have to learn how to do the most basic stuff once again.

This post is about "porting" the Recaptcha field and validation from sfFormExtraPlugin to Symfony2.

*Warning* as everyone else this is also new to me so this maybe not be the best way to do it but it
is the best i found while playing with the components.

### The battle plan

 * Create a new `Field` that extends `FieldGroup` and embeds two fields, one for the `response` and one
    for the `challenge`.

 * Create a Twig template that extends the default `form.twig` from `TwigBundle`

 * Create a new `Constraint` which is the object that gets added to the validator through metadata.

 * Create a `ConstraintValidator` for the previously created `Constraint`.

### Creating a new Field

This is kind of basic after reading the Form documentation at the symfony-reloaded.org website. First
we extend from `FieldGroup` and use the `FieldGroup::add()` method to embed a `TextareaField` and a
`TextField`.

<script src="http://gist.github.com/727073.js?file=RecaptchaField.php"></script>

### Creating a Constraint

A `Constraint` is a object that contains the different options for the `ConstraintValidator` to use 
when validating. For this Constraint we need a message and the private key that should be used when
verifying the entered information with the Recaptcha API.

<script src="http://gist.github.com/727073.js?file=Recaptcha.php"></script>

### Creating a ConstraintValidator

Nothing major happing here. `isValid` is called by when validating the `Form` and so it returns `true`
or `false`. If `false` a error have happend and the message from the constraint is set as the message
that should be displayed as an error.

<script src="http://gist.github.com/727073.js?file=RecaptchaValidator.php"></script>

### Using it in your application

Before all of this can be used in an application it is needed for to extend `TwigBundle\Resources\views\form.twig`
with a `recaptcha_field` block for easy form prototyping.

Create a `form.twig` in `app/views/` and add that template as a resource like [it is explained here.][TwigFormTheming] 

<script src="https://gist.github.com/727073.js?file=form.twig"></script>

Now when using `|render` in your twig template it should render the widget so long the correct options for the field
have been specified.

Also adding the validator to your `validation.yml` can be done like so:

<script src="http://gist.github.com/727073.js?file=validation.yml"></script>

This will trigger the validation to always check the `RecaptchaField` with the `RecaptcaValidator`.

And there you go you should now have a fully working Recaptcha widget in your form that is validated aswell.

[TwigFormTheming]: http://docs.symfony-reloaded.org/master/guides/forms/view.html#form-theming-twig-only.
