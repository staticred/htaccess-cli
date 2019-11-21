# htaccess CLI

A CLI tool to test how .htaccess files behave

## Installation

To start performing analysis on your code, require htaccess CLI in Composer:

```bash
composer require --dev madewithlove/htaccess-cli
```

Composer will install htaccess-cli's executable in its bin-dir which defaults to vendor/bin.

### Global installation

```bash
composer global require madewithlove/htaccess-cli
```

Then make sure you have the global Composer binaries directory in your ``PATH``. This directory is platform-dependent, see `Composer documentation <https://getcomposer.org/doc/03-cli.md#composer-home>`_ for details.
This allows you to use the tool as `htaccess` from every location in your system.

## Usage

Run the .htaccess CLI tester from a directory containing a .htaccess file.

```bash
# using global installation
htaccess http://localhost/foo

# using project-specific installation
vendor/bin/htaccess http://localhost/foo
```

Where the url is the request url you want to test your .htaccess file with.

![Screenshot 2019-11-21 at 16 34 40](https://user-images.githubusercontent.com/1398405/69352228-d65b3100-0c7c-11ea-8bed-ae938cec538c.png)

### Usage through Docker

```bash
# install the container
docker pull madewithlove/htaccess-cli

# run the htaccess tester in the current folder
docker run --rm -v $PWD:/app madewithlove/htaccess-cli [url] <options>
```

## CLI Options

The following options are available:

```
-r, --referrer[=REFERRER]          The referrer header, used as HTTP_REFERER in apache
-s, --server-name[=SERVER-NAME]    The configured server name, used as SERVER_NAME in apache
-e, --expected-url[=EXPECTED-URL]  When configured, errors when the output url does not equal this url
-h, --help                         Display a help message
```

### Note

The tool simulates only one pass through the server, while Apache will do multiple if you get back
on the same domain. This is a feature we might still add in the future, but it's a limitation for now.
