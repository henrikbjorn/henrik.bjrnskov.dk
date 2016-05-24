Blog
====


``` bash
$ ./vendor/bin/sculpin --env=prod generate
$ aws --profile=blog s3 sync --acl=public-read --delete output_prod s3://henrik-bjrnskov-dk
```
