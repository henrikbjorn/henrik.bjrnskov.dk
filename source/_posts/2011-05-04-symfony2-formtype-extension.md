---
layout: post
title: 'Symfony2: FormType extensions'
permalink: symfony2-formtype-extension
---

A couple of weeks ago the big Form component refactoring was merged into Symfony master. This changed
a lot of things about how form handling was done and opened a multitude of possibilities.

This blog post is about allowing to set the `attr` option directly on a type through a FormType
extension. A FormType extension is called by the FormComponent when building a Form or when creating
a new FormView. It have the same methods as a Form but allows you to change the default Type.

For this to work it is needed to change the following.

* Create a new class that inherits from AbstractTypeExtension
* Register our TypeExtension with the DIC with the appropiate tag.

### FieldFieldTypeExtension

First we create the Extension. Threw mine in `Form/Extension/FieldTypeExtension.php`.

<script src="https://gist.github.com/954881.js?file=FieldTypeExtension.php"></script>

`getExtendedType` returns the name of the extended type. By returning `field` this extension applies
to all FormTypes. So every type will have the ability to set attributes for its elements from it's
options.

### Registrating with Service Container

<script src="https://gist.github.com/954881.js?file=gaming.xml"></script>

By using the tag `form.type_extension` it will automatically be added to the Form component. Also
the `alias` must be the name of the field extended and as previous it is `field`.

### Using it! Weeee

By doing the steps above it should now work! And heres is an example where i use it to set the class
for a wysiwyg editor.

<script src="https://gist.github.com/954881.js?file=CommentFormType.php"></script>
