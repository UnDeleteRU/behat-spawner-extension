Behat spawner extension
========================

[![Latest Stable Version](https://poser.pugx.org/da-eto-ya/behat-spawner-extension/v/stable.png)](https://packagist.org/packages/da-eto-ya/behat-spawner-extension)
[![License](https://poser.pugx.org/da-eto-ya/behat-spawner-extension/license.png)](https://packagist.org/packages/da-eto-ya/behat-spawner-extension)
[![Build Status](https://travis-ci.org/da-eto-ya/behat-spawner-extension.svg?branch=master)](https://travis-ci.org/da-eto-ya/behat-spawner-extension)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/da-eto-ya/behat-spawner-extension/badges/quality-score.png?s=aa4d3b23969f9e7e838fe29237b8c4ac20c653cf)](https://scrutinizer-ci.com/g/da-eto-ya/behat-spawner-extension/)
[![Total Downloads](https://poser.pugx.org/da-eto-ya/behat-spawner-extension/downloads.png)](https://packagist.org/packages/da-eto-ya/behat-spawner-extension)

Overview
--------

Simple extension for spawn processes before you run your Behat test suite.

For example, it is useful when you run testing server instance (local php
server, Selenium, PhantomJS, etc) on multiple environments (developer's
machine, CI-server, etc) without need for bash/cmd script to run testing suite.

Installation
------------

Define dependencies in your `composer.json`:

``` javascript
{
    "require": {
        ...
        "da-eto-ya/behat-spawner-extension": "1.1.*@dev"
    }
}
```

Install/update your vendors:

``` bash
$ curl http://getcomposer.org/installer | php
$ php composer.phar install
```

Or if you have composer installed global-wise on machine, you can use it:

``` bash
$ composer install
```

Configure
---------

Activate and configure extension in your `behat.yml`:

``` yaml
# behat.yml
default:
    # ...
    extensions:
        Behat\SpawnerExtension\ServiceContainer\SpawnerExtension:
            commands:           # array-formatted command list
                - [php, -S, localhost:8880, -t, web, web/index.php]
                - ['./bin/phantomjs', '--webdriver=8643']
            work_dir: '.'       # by default, use current directory
            win_prefix: ''      # prefix commands on Windows (default: empty)
            nix_prefix: 'exec'  # prefix commands on *-nix (default: 'exec')
            sleep: 0            # sleep after spawn (in milliseconds, default 0)
```

All settings are optional. `commands` option if general for use this extension.

Current, commands should be declared as arrays of strings (program name
and arguments) for proper escaping on different operating systems.

Also, for heterogeneous setups, you can specify `win_prefix` and `nix_prefix`,
but do it with care. You can specify `work_dir` as working directory for all
commands.

And you can specify `sleep` option in milliseconds for pause between spawn
processes and start process features (for example, if you should wait for
spawned server to start). Pause will be only if you declare some commands,
obviously.

Changelog
---------

### v1.0.1
- Fix bugs with configuration on Windows (default `work_dir` equals `'.'` now)

### v1.0.0
- Initial version

TODO
----

- Allow simple string command definition
- Add commands configuration validation
- Add checks for process pipeline (stop only after spawn)

Contribution
------------

It is more than welcome as always!

Feel free to contact me and post issues/bugs/enhancements through
[the issue system](https://github.com/da-eto-ya/behat-spawner-extension/issues/new).
