---
layout: post.twig
title: Running the Symfony test suite
published: true
---

For people starting to contribute to Symfony it can be kind of hard to get the test suite running specially if the contrubutor have not had any experience with PHPUnit before.

So here is a quick walkthrough on how to the test suite running step by step.

First cloning the repository. This is straightforward and shouldn't raise any questions.

    $ git clone https://github.com/symfony/symfony symfony
    $ cd symfony

Now installing the dependencies. Composer supports having dependencies that are only required for development. We need thoose to be able to run all of the tests.

    $ composer.phar install --dev

Composer will then fetch all of the dependencies and resolve them. It does take a few minutes but then it is done everything we need should be installed.

The last thing is to run the unit tests. And this is very simple.

    $ phpunit

Congratulations. You have just setup the Symfony test suite.
