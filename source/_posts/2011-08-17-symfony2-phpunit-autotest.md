---
layout: post
title: 'Symfony2: PHPUnit autotesting application'
permalink: symfony2-phpunit-autotest/
---

For a long time the ruby world have had autotest which will start testing everytime a `.rb` file changes.
So why not add this to your Symfony2 application?

With the help of a little rubygem called [watch](http://rubygems.org/gems/watchr) this is possible and frankly ridiculously
easy.

    # Copyright (C) 2011 by Henrik Bjornskov <henrik@bjrnskov.dk>
    # 
    # Permission is hereby granted, free of charge, to any person obtaining a copy
    # of this software and associated documentation files (the "Software"), to deal
    # in the Software without restriction, including without limitation the rights
    # to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    # copies of the Software, and to permit persons to whom the Software is
    # furnished to do so, subject to the following conditions:
    # 
    # The above copyright notice and this permission notice shall be included in
    # all copies or substantial portions of the Software.
    # 
    # THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    # IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    # FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    # AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    # LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    # OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    # THE SOFTWARE.

    watch '^src/.*.php' do |match|
        # If match[0] ends in Test.php lets assume it is a test file and done do the 
        # replacement magic

        test = match[0]

        unless test.end_with?('Test.php')
            test = test.sub(/^((.*)Bundle(\/))/, "\\1Tests/").sub(/\.php$/, "Test.php")
        end

        if File.exists?(test)
            system "phpunit -c app #{test}"
        else
            puts "'#{test}' does not exists."
        end
    end

This file will run `phpunit -c app TheChangedTest.php` everytime a `*Test.php` file is changed in your application.

To get it working do the following:

    $ gem install watchr
    $ cd /path/to/symfony-project
    $ wget https://raw.github.com/gist/1151531/f12b125fed843086c05377d4f76185797121cbc6/phpunit.watchr
    $ watchr phpunit.watchr
