---
layout: post
title: 'Symfony2: RecaptchaFieldType v2'
permalink: symfony2-recaptcha-v2
---

Sometime ago i wrote about the new Form framework for Symfony2 and since then it have gotten a major
overhaul. The old blog post is therefor obsolete so i wanted to update the code and the post so others
also can get an insight into creating custom field types and this time a transformer aswell.

This post is mainly made up of code. The code is embedded from GitHub.

### What is the desired goal?

As the previous post the goal is to end up with a custom form field and some validation for it. 
The difference this time is that no code is needed for the Validator component as the validation
will be done by a DataTransformer. A transformer does a kind of pre validating of form fields by
throwing exceptions when transforming fails.

### Transforming

Every DataTransformer have two methods `transform` and `reverseTransform` which are defined by 
DataTransformerInterface.

`reverseTransform` is called when values from the binded data needs to be transformed into its original
state. So for RecaptchaTransformer this method will get the query parameters Recaptcha js widget uses
and call their api for validating the response. Also if the js widget isnt used it will gracefully
use the original parameters that was submitted by the form.

`transform` will just return the code as their isnt any need to transform something into its presentation
state.

<script src="https://gist.github.com/962347.js?file=RecaptchaTransformer.php"></script>

There is no need to defined a service for this as it will be instantiated by the custom FieldType.

### Custom FieldType which is just awesome

Every form and field in Symfony is now just made of FieldTypes. A Form object only ties FieldTypes
together. This means that every type can embed other fields and in that way creating nested forms
known from Symfony 1.x and before the refactoring.

And so it is no different to create a custom FieldType than creating a Form. RecaptcaFieldType will
have two embedded fields called `recaptcha_challenge_field` and `recaptcha_response_field`. The first
will be a text field and the next a hidden field with a default value of "manual challenge" so recaptca
will work even when javascript is disabled.

<script src="https://gist.github.com/962347.js?file=RecaptchaType.php"></script>

Before the FieldType is ready to be used it is needed to add it to a DependencyInjection container
so Request is auto injected into its constructor and to make the use case even simpler.

<script src="https://gist.github.com/962347.js?file=gaming.xml"></script>

RecaptchaFieldType is now ready to be used.

<script src="https://gist.github.com/962347.js?file=example.php"></script>

### Presentation of the field.

The last step is now to add the presentation needed for the right widget to be rendered.
Fortunately this is pretty easy to do by using Form themes. If you dont know how this works read about
it on symfony.com under the documentation.

The `getName` method on our fields returns the name which is used to identify the field in twig block
so it can be targetted specificly. And there is the code needed to be inserted into your form twig theme.

<script src="https://gist.github.com/962347.js?file=recaptcha.html.twig"></script>

Hopefully this poorly written blog post have been some help while figuring out how to use FieldTypes
in Symfony2 and integrating them with a real project.
