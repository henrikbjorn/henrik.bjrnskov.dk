---
layout: post
title: 'Symfony2: Quick tip for your security configuration'
permalink: symfony2-security-configuration-tip
---

Earlier when playing around with the Security component and SecurityBundle i found that for all paths you can specify a route name
and the component will match it when check for the request paths. The following example shows how easy it is.

``` yaml
# app/config/security.yml
security:
    firewalls:
        default:
            pattern: ^/
            form_login:
                login_path: session_new
                check_path: session_new
            logout:
                path: session_delete
                target: homepage
```

So now you do not have to change your security configuration everytime you change the url of your application.

It does not work, you liar!?
----------------------------

Infact it does, but `check_path` is validated with the pattern specified for your firewall. This happens so early in the request
cycle that access to all routes are not available yet. So until that is fixed you should uncomment 
line 277 in `SecurityBundle/DependencyInjection/MainConfiguration.php` if you want it to work.
