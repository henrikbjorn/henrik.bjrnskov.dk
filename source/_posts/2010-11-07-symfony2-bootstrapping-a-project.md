---
layout: post
title: 'Symfony2: Bootstrapping a new project'
permalink: symfony2-bootstrapping-a-project/
---

__Update:__ This is have since been replaced by official Symfony2 distributions. Look at symfony.com
for more information.

With Symfony2 development moving faster and faster i suspect there is quite a few people wanting
to test it out.

In symfony 1.x we have had the symfony commandline utility that generated a whole project for us.
In Symfony2 this have been moved to its own repository and packaged as a PHAR file for easy
distribution. Theese are the steps i took for quickly setting up a Symfony2 playing environment.

__WARNING:__ When writing this i ran into a few problems and fixed them. The following steps will
only work after the fix have been merged into the repository. You can see the status here
https://github.com/symfony/symfony-bootstrapper/pull/2

Get the symfony-bootstrapper from https://github.com/symfony/symfony-bootstrapper.
Only the PHAR archive is needed since it is a compiled version of the source code.

Create your empty folder that will contain your application code

<script src="https://gist.github.com/666263.js?file=1.sh"></script>

Call the bootstrapper from inside your newly created folder. There is a bunch of other options aswell
that you can see by calling init without any parameters.

<script src="https://gist.github.com/666263.js?file=2.sh"></script>

Clone the Symfony2 source code and Zend Framework source code.

<script src="https://gist.github.com/666263.js?file=3.sh"></script>
    
Go to mysite.local or whatever your vhost setup is and celebrate your newly created Symfony2
application.
