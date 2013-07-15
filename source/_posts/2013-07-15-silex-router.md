---
layout: post
published: true
title: 'Using Symfony Router with Silex'
---

In my last post i showed how to load configuration files with Silex with
caching. This post is going to be about leveraging the full Router found
in Symfony Routing component.

Again this is a service provider which can be found in Flint.

Why?
----

The first reason is caching and performance. With Silex every `->get` call requires
the route to be added on every request. While this is awesome for small applications
it can be a real performance killer later on.

Second reason is loading from a configuration file such as `xml` or `yaml`. This makes
sure your routes are not scattered all around in different files and forces you to
use classes for controllers.

It is important to know that the old `->get` methods still works.

Getting Started
---------------

Add Flint to your composer file:

    {
        "require" : {
            "flint/flint" : "~1.4"
        }
    }

Now you need to add the service providers. Routing requires some of the services provided
by `ConfigServiceProvider` also you need to specific you initial routing resource.

    <?php

    $app = new Silex\Application;
    $app->register(new Flint\Provider\ConfigServiceProvider);
    $app->register(new Flint\Provider\RoutingServiceProvider, array(
        'routing.resource' => '/path/to/routing.xml',
        'routing.options' => array(
            'cache_dir' => '/path/to/cache',
        ),
    ));

If there is any routes in you `routing.xml` file you should be able to find the dumped routes
in your cache dir.

If you use `ServiceControllerServiceProvider` you can still use configuration files by
specifying the service id in `routing.xml` like so:

    <?xml version="1.0" encoding="UTF-8" ?>
    <routes xmlns="http://symfony.com/schema/routing"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://symfony.com/schema/routing http://symfony.com/schema/routing/routing-1.0.xsd">

        <route id="homepage" pattern="/">
            <default key="_controller">controller_default_service</default>
        </route>
    </routes>
