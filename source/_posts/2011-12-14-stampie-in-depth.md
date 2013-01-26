---
layout: post
title: 'Stampie an in depth look'
permalink: stampie-an-in-depth/
---

I must admit, my earlier post about Stampie (my email api wrapper) wasn't that 
explanatory. This blog post will hopefully rectify this.

## Introduction

So what is Stampie. Stampie is a API wrapper for the most common email
sending services. It provides a standard PHP Api to send emails. But
mostly it is a project to test TDD and experiment with a couple of
different things.

Stampie is developed with Dependency Injection and therefore there is a
lot of objects. At the start it can be quite cumbersome, but will make a
lot of sense if you start to develop and add additional provid

## Demonstration

To get a good feel of how it works and how the internals are laid out a
demonstration says a 1000 things more than 1000 words.

In this example we will use a HTTP Library for PHP developed by [Kriss
Wallsmith called Buzz](http://github.com/krisswallsmith/buzz). Buzz is a
lightweight library that sends request and unifies the response in an
object.

The service provider we will use is [SendGrid](http://sendgrid.com).
SendGrid is one of many providers supported.

``` php
<?php

// stampie.phar sets up autoloading with spl_autoload_register
require '/path/to/stampie.phar';

class Message extends \Stampie\Message
{
    public function getFrom() { return 'alias@domain.tld'; }
    public function getSubject() { return 'You are trying out Stampie'; }
    public function getText() { return 'So what do you think about it?'; }
}

$adapter = new Stampie\Adapter\Buzz(new Buzz\Browser());
$mailer = new Stampie\Mailer\SendGrid($adapter, 'username:password');

// Returns Boolean true on success or throws an HttpException for error
// messages not recognized by SendGrid api or ApiException for known errors.
$mailer->send(new Message('reciever@domain.tld'));
```

## Internals

As mentioned earlier Stampie uses [Dependency
Injection](http://en.wikipedia.org/wiki/Dependency_injection). But
Stampie also heavily uses the [Adapter
Pattern](http://en.wikipedia.org/wiki/Adapter_pattern) for its Mailers
and Adapters.

### Providers

Currently Stampie is bundled with 3 providers. Theese are:

- [SendMail](http://sendmail.com/)
- [MailChimp](http://mailchimp.com/) - Only their Simple Transactional Service
- [Postmark](http://postmarkapp.com/)

But Stampie is not limited to theese providers. Stampie is extendable
enough to also support Amazon SES, MailGun, CritSend and so on. All that
is needed is a `MailerInterface` implementation for their API if they
provide one over HTTP. Later an some points and an example to create a
custom provider is explained.

### Adapters

Because all the popular PHP frameworks have their own popular HTTP
client Stampie have an `AdapterInterface` that offers integration to
thoose HTTP Clients. Currently there is only 2 clients supported.

- [Buzz](http://github.com/kriswallsmith/buzz) - The library used in
    the demonstration and the most populair one in the
    [Symfony](http://symfony.com/) community.
- [Guzzle](http://guzzlephp.com/) - A more feature complete HTTP
    library.

As with Mailers the same is true for adapters. If you need an Adapter
for a HTTP Client that isn't already support all that is needed is an
implementation of `AdapterInterface`.

### Tests

Stampie is heavily tested with PHPUnit. PHPUnit is the defacto standard
for testing in the PHP world and for Symfony. To ease the testing
Stampie have a lot of Interfaces.

Tests are also the reason for Dependency Injection usage.

Stampie is tested continuously on every push to
[GitHub](http://github.com/henrikbjorn/stampie) with
[Travis](http://travis-ci.org).

Resources are not yet implemented.

The goal for code coverage is \~90%. This also means that contributions
and bug reports should include tests.

## Frameworks

As Stampie dosn't rely on any thing else that it self and a HTTP Client.
It has no ties to a Framework. This makes it easy to incorporate it to
your framework of choice. Below is a list of current framework
integrations.

### Symfony

Symfony integration is provided by
[HBStampieBundle](http://github.com/henrikbjorn/HBStampieBundle). The
bundle provides the Mailer as a service. Currently it only supports the
usage of Buzz.

## Feedback

If you have any feedback for Stampie or about this document or anything
else you want to see. Shoot me an tweet on
[**@henrikbjorn**](http://twitter.com/henrikbjorn) or in a [Bug Report
on GitHub](http://github.com/henrikbjorn/stampie).

Do you have a new Adapter or Mailer and want it to be included? Send a
[Pull Request on GitHub](http://github.com/henrikbjorn/stampie),
hopefully with tests included (that pass).
