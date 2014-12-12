BACKGROUND
----------
Submitted as final project for IT210 (Web Application Development) under AP Mini May Markie Sandoval.
This project is the 'Discussion boards' module of the hypothetical IT210 web app that caters to students'
and teachers' needs for engaging in classroom activities online.


CONTRIBUTORS
------------
Roinand Aguila
Monina Carandang
Rikki Lee Mendiola


OVERVIEW OF FUNCTION
--------------------
User management is not in the scope of this project but simple a User model and controller is used for the
requisite Log In/Log out functions.

Upon logging in, the user is redirected to a home page of feeds. All the latest posts are displayed, as well
as popular posts, and the current pinned post. 'Like' buttons are used to determine a post's popularity. Quick
commenting is allowed in the feeds page. Clicking on 'view' will direct the user to a post's indiviual post
page, which will allow the user to leave comments and view all the comments on that particular post. Options
such as delete and update are only available for the current user's own posts.

The user interface is simple and eye-catching. It takes design cues from the social networking trends of disaplying
feeds and updates without being too cluttered.




REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](http://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this application template using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:1.0.0-beta2"
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
