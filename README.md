XLF Generator
========================

With this Symfony Tool you can upload and/or generate new XLF Files with an Form Input.

![Screenshot of the XLF Generator Tool](assets/img/xlfgenerator.jpg "Screenshot of the XLF Generator Tool")

Requirements
------------

  * PHP 7.1.3 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][1].

Installation
------------

Execute this command to install the project:

```bash
$ composer install
```

Usage
-----

There's no need to configure anything to run the application. Just execute this
command to run the built-in web server and access the application in your
browser at <http://localhost:8000>:

```bash
$ cd rnxlffgen/
$ php bin/console server:run
```

Alternatively, you can [configure a fully-featured web server][2] like Nginx
or Apache to run the application.

To Do's
-----

  * XML Valdidator
  * XML Download
  * Better UI

```
[1]: https://symfony.com/doc/current/reference/requirements.html
[2]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html

