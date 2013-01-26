---
layout: post
title: Hosting Symfony2 on lighttpd
---

Recently i have been trying to get some new knowledge with servers and setting them up.
I have grown fund of lighttpd because of its easy configuration and that is even with the rewrites
Symfony requires.

I am using php-fpm with this configuration on Ubuntu 12.04.

``` text
server.modules += ("mod_fastcgi")
fastcgi.server += ( ".php" =>-
    ("localhost" => (
            "socket" => "/tmp/php-fpm.sock"
        )
    )
)
```

And this is so the fully functional configuration for a Symfony2 vhost

```
$HTTP["host"] =~ "myhost\.tld" {
    server.document-root = "/home/user/www/myhost/web"

    url.rewrite-if-not-file = (
        "^/$" => "$0",
        "^(?!app_dev\.php/)[^\?]+(\?.*)?" => "app.php/$1$2",
    )
}
```

I dare everyone to do setup a Symfony2 application quicker in nginx or Apache. Also as a bonus here is a dynamic rewrite
which will take `{project}.{username}.domain.tld` and point it into `/home/{username}/www/{project}/web`

```
server.modules += ( "mod_evhost" )

$HTTP["host"] =~ "\.piglet\.bjrnskov\.dk" {
    evhost.path-pattern = "/home/%4/www/%5/web"
}
```
