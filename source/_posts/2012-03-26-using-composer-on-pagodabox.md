---
layout: post
title: 'Using Composer on Pagodabox'
---

In a world where cloud is king and it is dead easy to setup a project the support for hooks and vendor installing is extremly little. Some time ago Pagodabox rolled out hooks functionality which makes it easy to use Composer instead of submodules for your next project - Yes Symfony2 can run on Pagodabox.

    web1:
        after_build:
        - "if [ ! -f composer.phar ]; then curl -s http://getcomposer.org/installer | php; fi; php composer.phar install"

The after_build hook is used before the application is packaged, so this means there is write access to the sourcecode. The little bash script check for a `composer.phar` file and if that is not found, it downloads Composer. And last it install thes dependencies.
