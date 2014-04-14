Zend Framework 2 Exercise (Vacancies)
=====================================

Introduction
------------

This is a simple vacancies application using the ZF2 MVC layer and Doctrine 2 as ORM.
This application is meant to be used as a simple example for ZF2 usage.

Installation
------------

The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the `install` command:

```bash
curl -s https://getcomposer.org/installer | php --
php composer.phar install
```

Or if you have `composer` installed globally on developer machine you can leave
`composer` download:

```bash
composer install
```

After installation you can copy `config/autoload/local.php.dist` to `config/autoload/local.php.`
and change default local options.

Web Server Setup
----------------

### PHP CLI Server

The simplest way to get started is to start the internal PHP cli-server in the root directory:

```bash
php -S 127.0.0.1:8080 -t public/ public/index.php
```

This will start the cli-server on port 8080, and bind it to all network
interfaces.

**Note: ** The built-in CLI server is *for development only*.

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

```apache
<VirtualHost *:80>
    ServerName zf2-exercise.localhost
    DocumentRoot /path/to/zf2-exercise/public
    <Directory /path/to/zf2-tutorial/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```
