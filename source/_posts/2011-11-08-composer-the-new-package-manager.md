---
layout: post
title: 'Composer - The new package management tool'
permalink: composer-the-new-package-manager/
---

Personally i have never been to found of managing PHP Packages through pear of by having some version
control system inclusion of my dependencies (svn:externals, git submodules and so on). Mostly because
of PEAR having dependencies and package.xml defined as xml. I HATE xml with a passion. 

But now there is a new library/tool starting to form and fix thoose things. It is called [Composer](http://github.com/composer/composer)
and uses a `composer.json` file to handle packages. This rocks for 2 reasons.

1. JSON is incredible easy to read and indent.
2. Everybody knows this syntax from Javascript and/or Twig (Arrays and Hash literals)

Because this tool is new there isnt a __lot__ of packages. But most of the Symfony2 community and the other people who have started
playing with the tools have put packages up on [Packagist.org](http://packagist.org). Which currently is the main place to find
packages.

I encourage all to go play with it. And join #composer on Freenode.

The dokumentation is currently rather sparse so here is an example composer.json file which is from one of my Symfony2 projects.

    {
        "name" : "henrikbjorn/super-secret",

        "autoload" : {
            "psr-0" : {
                "SuperSecret" : "src/",
                "Twig_"       : "vendor/twig/twig/lib"
            }
        },

        "require": {
            "php"                  : ">=5.3.0",

            "twig/twig"            : ">=1.3",
            "symfony/symfony"      : ">=2.1",
            "doctrine/mongodb-odm" : "*",

            "symfony/mongodb-odm-bundle" : "master-dev"
        }
    }

Some of the more fun and exiting features are.

* Automatic autoload.php generation by psr-0 standard. Just include `vendor/.composer/autoload.php`.
* Package resolvement. Add `doctrine/orm` and get `doctrine/dbal` and `doctrine/common` for free.
* Possible to overwrite the target path. This allows for Symfony2 bundles (and other) to have the correct path for their loading needs.
* Uses PEAR, Git, GitHub as repository options. This means you can also install that PEAR package you depend on.
* hopefully a lot more to come.
