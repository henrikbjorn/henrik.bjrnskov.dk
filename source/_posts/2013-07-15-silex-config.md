---
layout: post
title: 'Configuration files in Silex'
published: true
---

Lately i have been using Silex more and more. And as doing so i needed
additional functionality. This functionality included doing configuration
via `.json` files. Furtonately Symfony have a Config component that defines
interfaces for loading and caching loaded configuration files so i set
out to port this to Silex. The result is `Flint\Config` which is part
of my small enhancement library for Silex.

Flint is completely decoupled from Silex and it is a library. Which is
a very important distinction to make.

So what does it do?
-------------------

It is very simple. It supports loading json files into a pimple container
as parameters. Loaded json files are dumped as `php` files so you do not
need to parse it on the next request.

Also it allows placeholders such as `#ENV_VAR#` and `%parrameter_name%`. The
latter will be replaced with an already defined parameter in the pimple
instance.

Getting Started
---------------

To use it standalone just add Flint to you composer file:

    {
        "require" : {
            "flint/flint" : "~1.4"
        }
    }

And register the `ConfigServiceProvider`.

    <?php

    $app = new Silex\Application;
    $app->register(new Flint\Provider\ConfigServiceProvider, array(
        'config.cache_path' => '/path/to/cache_dir',
    ));
    $app['configurator']->configure($app, '/path/tp/config.json');

If you want to learn more about Flint or more configuration features such as
including other config files from within a json file head over to
[the documentation](http://flint.rtfd.org).

Numbers
-------

Here are some numbers that show the improvement you get by using cached config files.

    Flint\Benchmark\Config\ConfiguratorBenchmark
        Method Name                     Iterations    Average Time      Ops/second
        -----------------------------  ------------  --------------    -------------
        loadCachedConfigFile         : [10,000    ] [0.0000248255253] [40,281.12149]
        loadNonCachedConfigFile      : [10,000    ] [0.0001957096338] [5,109.61050]
        loadSimpleNonCachedConfigFile: [10,000    ] [0.0001974114180] [5,065.56313]
