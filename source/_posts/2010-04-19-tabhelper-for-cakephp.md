---
layout: post
title: 'TabHelper for CakePHP 1.2'
permalink: tabhelper-for-cakephp/
---

Repost of a old article i wrote for the Bakery and the original [copy can be found here.][OriginalArticle]

Okay, in the Bakery there is a lot of MenuHelper's and TabHelper's which tries to produce a nice way
to check the controller params etc and select the active element. This helper does exactly
that in an alternative way.

As written in the intro there is about a dusin other helpers that does exactly this, or close to it. But my needs where a little different. The other helpers can provide you with more than one element with the "active" class, if there is more than one match.

An example would be if you have a tab witch is set to be active on the controller 'users' and
another one where the match should be users controllers and the action view. When you go to
/users/view both of them would be active.

And to counter this. This helper takes all the params, action, controller etc and calculates matching
points and the match with most points wins. So i the example above the last rule would win.

Also i needed this Helper to create a link, to another action etc than the matching one. So i came
up with this API.

This is taken from my application, in danish i am afraid but should be clear enough.

<script src="http://gist.github.com/370818.js"></script>

As with all other element generating functions in cakephp the last array is options, passed into
the ul element.

Should proberly have noted that this is just a rewrite of an idea by Felix Geisendörfer of
Debuggable Ltd. The original source can be found at [debuggable.com][Debuggable] where he uses
Regex to find out how many points a link should have.

<script src="http://gist.github.com/370819.js"></script>

[OriginalArticle]: http://bakery.cakephp.org/articles/view/tabhelper
[Debuggable]: http://debuggable.com/posts/macgyver-menu-for-cakephp-whats-the-active-menu-item:480f4dd6-c044-436e-bbde-4ed8cbdd56cb 
