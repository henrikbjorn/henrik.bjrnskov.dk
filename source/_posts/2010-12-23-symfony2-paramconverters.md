---
layout: post
title: 'Symfony2: ParamConverter''s'
permalink: symfony2-paramconverters
---

__Update:__ This functionality have since been moved back to [FrameworkExtraBundle released by Sensio.][SensioFrameworkExtraBundle]

_Just to make it clear. This was backported from FrameworkExtraBundle and originally authored by Fabien_

With Fabien merging the pull request for ParamConverters last night a new feature have arrived for
FrameworkBundle called ParamConverters.
A ParamConverter is used to convert typehints on a Controller action into an object by calling
a `ConverterManager` that runs through all attached Converters until it finds one that supports
the given `ReflectionClass`.

This is very useful especially for Doctrine2 Entities where the route gives the Request a `id`
attribute and the Action needs the Entity Object. By default DoctrineBundle ships with a
[DoctrineConverter][DoctrineConverter] that first looks for a `id` attribute and if that is not
found it will try and find a Entity by using all request attributes that matches a mapped fieldName.

To use this new feature it required to enabled it in you `app/config.yml` file:

<script src="http://gist.github.com/752798.js?file=config.yml"></script>

This will make sure that the listener is connected to the right event and will populate the manager
with all Converters that is tagged with `request.param_converter` in your service container configs
and with the priority specified with `priority: 0` (optional when tagging a service)

### Making your own converter

Fortunately it is very easy to create your own converter. For a project i am doing i use a
Converter to transform a `Site` typehint into an instance of `Application\GamingBundle\Document\Site`.

To do this you create a `ParamConverter` that extends `ConverterInterface` like so:

<script src="http://gist.github.com/752798.js?file=SiteConverter.php"></script>

And then add it to your `config.xml` (or `config.yml` if you use YAML for you configurations)

<script src="http://gist.github.com/752798.js?file=config.xml"></script>

The high priority specified will make sure this converter is used before the one bundled with `DoctrineBundle`.

### Gotchas

The listener that runs the converters will throw a `\InvalidArgumentException` when a typehinted
object can't be converted and it is not optional. So a method definition like the following would
not throw an exception if convertion failed.

<script src="http://gist.github.com/752798.js?file=Controller.php"></script>

[SensioFrameworkExtraBundle]: http://github.com/sensio/FrameworkExtraBundle
[DoctrineConverter]: https://github.com/fabpot/symfony/blob/master/src/Symfony/Bundle/DoctrineBundle/Request/ParamConverter/DoctrineConverter.php
