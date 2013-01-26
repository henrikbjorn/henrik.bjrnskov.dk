---
layout: post
title: 'Symfony2: Add Cross Site Request Forgery protection to login forms'
---

When talking with [@jmikola](http://twitter.com/jmikola) on #Symfony-dev this afternoon we got into the subject of
cross site request forgery and symfony2 login forms. And it seems that `form-login` already supports this but neither of us knew how it worked.
So here is another quick tip. This time about securing you login form from cross site attacks.

To add it to your login form it is needed to add `csrf_provider` key about what provider you want to use. For this
we can use the default one that the Form component uses. Also we can add a `csrf_parameter` key but theres a default with the value
of `_csrf_token`.

Here is a full example of the config file:

``` yaml
# app/config/security.yml
security:
    firewalls:
        default:
            pattern: ^/
            form_login:
                login_path: session_new
                check_path: session_new
                csrf_provider: form.csrf_provider
```

Obviously now when you submit a login form it wont work because they token is not getting printed out. So lets fix that with a couple
of lines of code.

First the controller action. The string sent to the generateCsrfToken method is used for generation. It is the "intention" and 
`authentication` is the default for form login.

``` php
<?php

class SecurityController
{
    public function loginAction()
    {
        // Here goes all the normal stuff like getting the last username and error
        // so we are playing $username and $error is already set.

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authentication');

        return $this->container->renderResponse('MyBundle:Security:login.html.twig', array(
            'username' => $username,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));
    }
}
```

Last but not least the template

    {% verbatim %}
    {% endverbatim %}
