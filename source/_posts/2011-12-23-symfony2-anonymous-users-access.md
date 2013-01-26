---
layout: post
title: 'Symfony2: Only allow anonymous users access'
permalink: symfony2-anonymous-users-access
---

__Update:__ This have been extracted into [Vandpibe](http://github.com/henrikbjorn/vandpibe).
My collection of small Symfony component/bridges.

When using Symfony2's Security component you can at first feel it is a bit bloated and too complex for the
job. But under the hood there is a powerful and every extendable product which proved useful today.

I needed to only allow anonymously authenticated users access to pages such as `/login` and `/register`. To do this
there is two methods (that i know of).
The first one is to use JMSSecurityExtraBundle which have a feature called `expressions` that generates php code from human
reable text (almost human readably)

``` yaml
# app/config/security.yml
security:
    access_control:
        - { path: /login, access: "isAnonymous()" }
```

The other way is to implement a custom voter. This is a bit more work, but for my solution it is perfect (i dont want to rely on
much magic). The voter takes inspiration from `AuthenticatedVoter` which is a part of core.

``` php
<?php

namespace FooBar\FooBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolverInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class AnonymousVoter implements VoterInterface
{
    /**
     * The role check agains
     */
    const IS_ANONYMOUS = 'IS_ANONYMOUS';

    /**
     * @var AuthenticationTrustResolverInterface $authenticationTrustResolver
     */
    protected $authenticationTrustResolver;

    /**
     * @param AuthenticationTrustResolverInterface $authenticationTrustResolver
     */
    public function __construct(AuthenticationTrustResolverInterface $authenticationTrustResolver)
    {
        $this->authenticationTrustResolver = $authenticationTrustResolver;
    }

    /**
     * @param string $attribute
     * @return Boolean
     */
    public function supportsAttribute($attribute)
    {
        return static::IS_ANONYMOUS === $attribute;
    }

    /**
     * @param string $class
     * @return Boolean
     */
    public function supportsClass($class)
    {
        return true;
    }

    /**
     * Only allow access if the TokenInterface isAnonymous. But abstain from voting
     * if the attribute IS_ANONYMOUS isnt supported.
     *
     * @param TokenInterface $token
     * @param object $object
     * @param array $attributes
     * @return integer
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        foreach ($attributes as $attribute) {
            if (!$this->supportsAttribute($attribute)) {
                continue;
            }

            // If the user is anonymous then grant access otherwise deny!
            if ($this->authenticationTrustResolver->isAnonymous($token)) {
                return VoterInterface::ACCESS_GRANTED;
            }

            return VoterInterface::ACCESS_DENIED;
        }

        return VoterInterface::ACCESS_ABSTAIN;
    }
}
```

To use this snippet, save it somewhere in your project and modify the namespace to match. And then use the following as a template
to register it with the DependencyInjection Container.

``` xml
<container xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd" xmlns="http://symfony.com/schema/dic/services" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <parameters>
        <parameter key="foobar.security.authorization.voter.anonymous.class">FooBar\FooBundle\Security\Authorization\Voter\AnonymousVoter</parameter>
    </parameters>

    <services>
        <service id="security.access.anonymous.voter" class="%foobar.security.authorization.voter.anonymous.class%" public="false">
            <tag name="security.voter"/>
            <argument type="service" id="security.authentication.trust_resolver"/>
        </service>
    </services>
</container>
```

also remember to add it to the config.

``` yaml
# app/config/security.yml
security:
    access_control:
        - { path: /login, roles: IS_ANONYMOUS }
        - { path: /forgot-password, roles: IS_ANONYMOUS }
        - { path: /register, roles: IS_ANONYMOUS }
```

And just because test are a good thing and awesome. Here is the corresponding test.

``` php
<?php

namespace FooBar\FooBundle\Tests\Security\Authorization\Voter;

use FooBar\FooBundle\Security\Authorization\Voter\AnonymousVoter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class AnonymousVoterTest extends \PHPUnit_Framework_TestCase
{
    public function testSupportsClass()
    {
        $voter = new AnonymousVoter($this->createResolverMock());
        $this->assertTrue($voter->supportsClass('stdClass'));
        $this->assertTrue($voter->supportsClass('Just return true always'));
    } 

    public function testSupportsAttribute()
    {
        $voter = new AnonymousVoter($this->createResolverMock());
        $this->assertTrue($voter->supportsAttribute(AnonymousVoter::IS_ANONYMOUS));
        $this->assertFalse($voter->supportsAttribute('ROLE_USER'));
        $this->assertFalse($voter->supportsAttribute('IS_AUTHENTICATED_ANONYMOUSLY'));
    }

    public function testVote()
    {
        $token = $this->createTokenMock();

        // Voter returns VoterInterface::ACCESS_ABSTAIN when its attribute isnt found
        $voter = new AnonymousVoter($this->createResolverMock());
        $this->assertEquals(VoterInterface::ACCESS_ABSTAIN, $voter->vote($token, new \stdClass, array()));

        // Voter returns ACCESS_DENIED if token is not anonymous and our attribute is present
        $this->assertEquals(VoterInterface::ACCESS_DENIED, $voter->vote($token, new \stdClass, array(
            AnonymousVoter::IS_ANONYMOUS,
        )));

        // Voter returns ACCESS_GRANTED if the token is anonymous and our attribute is present
        $voter = new AnonymousVoter($this->createResolverMock(true));
        $this->assertEquals(VoterInterface::ACCESS_GRANTED, $voter->vote($token, new \stdClass, array(
            AnonymousVoter::IS_ANONYMOUS,
        )));
    }

    protected function createResolverMock($isAnonymous = false)
    {
        $resolver = $this->getMock('Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolverInterface');
        $resolver
            ->expects($this->any())
            ->method('isAnonymous')
            ->will($this->returnValue($isAnonymous))
        ;

        return $resolver;
    }

    protected function createTokenMock()
    {
        return $this->getMock('Symfony\Component\Security\Core\Authentication\Token\TokenInterface');
    }
}
```
