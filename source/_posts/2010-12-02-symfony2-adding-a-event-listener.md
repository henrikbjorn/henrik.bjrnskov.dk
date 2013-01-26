---
layout: post
title: 'Symfony2: Adding a EventListener'
permalink: symfony2-adding-a-event-listener/
---

__Update:__ The EventDispatcher in Symfony2 have since been changed and this post is now outdated.

Short and the dead easy way to add a listener that is auto registered with the Symfony2 `EventDispatcher`.

The first thing that is needed is to create the listener itself. But there are a couple of rules that must be followed for it to be auto registered.

 1. It must implement a `register` method that takes the `EventDispatcher` and a priority as an `integer` value.
 2. It needs to be added as a Service and tagged with `kernel.listener` and optionally have a `priority` set aswell.

The service in yml format:

<script src="http://gist.github.com/727314.js?file=config.yml"></script>

Template listener:

<script src="http://gist.github.com/727314.js?file=CustomListener.php"></script>
