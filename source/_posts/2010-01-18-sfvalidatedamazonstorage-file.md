---
title: sfValidatedAmazonStorageFile
permalink: sfvalidatedamazonstorage-file/
layout: post
---

Just a snippet that will allow symfony sfValidatorFile to save its file to Amazon S3, only
limitation is that it requires a s3 stream wrapper to be implemented, else it will fail.

Personally i use [`Services_Amazon_S3` from pear.net][PearAmazon] [developed by aggemam.dk][aggemam].

<script src="http://gist.github.com/279451.js"></script>

[PearAmazon]: http://pear.php.net/Services_Amazon_S3
[aggemam]: http://aggemam.dk
