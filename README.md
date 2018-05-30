ftp-library
===========

[![Build Status](https://travis-ci.org/webeweb/ftp-library.svg?branch=master)](https://travis-ci.org/webeweb/ftp-library) [![Coverage Status](https://coveralls.io/repos/github/webeweb/ftp-library/badge.svg?branch=master)](https://coveralls.io/github/webeweb/ftp-library?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/webeweb/ftp-library/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/webeweb/ftp-library/?branch=master) [![Latest Stable Version](https://poser.pugx.org/webeweb/ftp-library/v/stable)](https://packagist.org/packages/webeweb/ftp-library) [![Latest Unstable Version](https://poser.pugx.org/webeweb/ftp-library/v/unstable)](https://packagist.org/packages/webeweb/ftp-library) [![License](https://poser.pugx.org/webeweb/ftp-library/license)](https://packagist.org/packages/webeweb/ftp-library) [![composer.lock](https://poser.pugx.org/webeweb/ftp-library/composerlock)](https://packagist.org/packages/webeweb/ftp-library)

Integrates FTP in your projects.

`ftp-library` uses a rolling release based on git master branch which is
considered stable.

---

## Compatibility

[![PHP](https://img.shields.io/badge/PHP-%5E5.6%7C%5E7.0-blue.svg)](http://php.net)

Requires:

[![ext-ssh2](https://img.shields.io/badge/PHP-ext--ssh2-blue.svg)](http://php.net/manual/en/book.ssh2.php)

---

## Installation

Open a command console, enter your project directory and execute the following
command to download the latest stable version of this package:

```bash
$ composer require webeweb/ftp-library "~1.0@dev"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the
Composer documentation.

---

## Testing

To test the package, is better to clone this repository on your computer.
Open a command console and execute the following commands to download the latest
stable version of this package:

```bash
$ mkdir ftp-library
$ cd ftp-library
$ git clone git@github.com:webeweb/ftp-library.git .
$ composer install
```

Once all required libraries are installed then do:

```bash
$ vendor/bin/phpunit
```

---

## License

ftp-library is released under the LGPL License. See the bundled [LICENSE](LICENSE)
file for details.
