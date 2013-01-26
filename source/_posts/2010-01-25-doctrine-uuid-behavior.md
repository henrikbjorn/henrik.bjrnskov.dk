---
layout: post
title: 'Doctrine UUID behavior'
permalink: doctrine-uuid-behavior/
---

__Update:__ Do not use this, as it have been shown to not work because of weirdness in the way
Doctrine handle foreignKey relations.

I have cooked up a quick simple UUID Behavior for use with Doctrine, its very simple. It forces
the id (primaryKey) to be `char(36)` and when inserting a new row it will force set the `id` field
to a uuid string.

When generating the uuid it first checks for the [pecl.php.net/uuid][PeclUuid] extension else it
will create a uuid by a custom php fallback method (borrowed from String:uuid() in [cakephp.org][CakePHP]).

Usage is simple just as any other behavior add Uuidable to the actAs section.

<script src="http://gist.github.com/285756.js"></script>

<script src="http://gist.github.com/285757.js"></script>

[PeclUuid]: http://pecl.php.net/uuid
[CakePHP]: http://cakephp.org
