---
layout: post
title: 'Adding a little spice to symfony forms'
permalink: addding-a-little-spice-to-symfony-forms/
---

I have always hated the formatter in symfony for forms, mostly because i never had the time to read
the code and/or documentation to create my own so i could add the spice i wanted. Mostly i want to
render the errors for a form field at the top of a form, and then mark the corresponding field
with a css class.

This form formatter does exactly that, but it also adds a class to the row div, which contains the
label and input tag. The classname is determained by the type of the input with exception of
textareas where the class will be textarea otherwise it would be text, password, radio, checkbox etc.

The formatter will properly not suit your needs. It should give you a start where i did not have one.

<script src="http://gist.github.com/284036.js"></script>
