---
layout: post
title: 'Travis & Composer sitting in a tree K-I-S-S-I-N-G'
permalink: travis-and-composer-sitting-in-a-tree
---

The other day the Continuous integration testing service travis-ci.org announced they had integrated
PHP into their service. Which is wonderful news and with some of the Symfony2 bundles from FriendsOfSymfony
already added together with Doctrine2 and others quickly following them.

To integrate your project with travis the only thing necesarry is to have a `.travis.yml` file and a working
PHPUnit test setup like http://github.com/simplethings/SimpleThingsFormExtraBundle. Where the `Tests/vendors.php`
script is executed before the tests are perfomed. But it would be way cooler to just have Composer handle
the autoloading and dependencies. So here is a `.travis.yml` file that uses Composer to get the dependencies
and generate the autoloading.

    language: php

    php:
      - 5.3
      - 5.4

    before_script:
        - wget http://getcomposer.org/composer.phar
        - php composer.phar install

Very simple and straight forward. The following is happening before each test run.

1. Download `composer.phar` from http://getcomposer.org
2. Get the dependencies with composer by invoking its `install` command.

Next it is needed to add the following to your `bootstrap.php` file so Composer's autoloading
is used.

    <?php

    if (!@include __DIR__ . '/../vendor/.composer/autoload.php') {
        die(<<<'EOT'
    You must set up the project dependencies, run the following commands:
    wget http://getcomposer.org/composer.phar
    php composer.phar install
    EOT
        );
    }

And last but not least add the `vendor` and other related files to your `.gitignore` file.

    vendor
    composer.phar
    composer.lock

To test it out your self go get Composer, install your dependencies and run it with phpunit like so

    $ phpunit
