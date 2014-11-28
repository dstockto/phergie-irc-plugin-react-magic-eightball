# phergie/phergie-irc-plugin-react-magic-eight-ball

[Phergie](http://github.com/phergie/phergie-irc-bot-react/) plugin for Helping users make decisions.

[![Build Status](https://secure.travis-ci.org/dstockto/phergie-irc-plugin-react-magic-eightball.png?branch=master)](http://travis-ci.org/dstockto/phergie-irc-plugin-react-magic-eightball)
[![Coverage Status](https://img.shields.io/coveralls/dstockto/phergie-irc-plugin-react-magic-eightball.svg)](https://coveralls.io/r/dstockto/phergie-irc-plugin-react-magic-eightball)
[![Code Climate](https://codeclimate.com/github/dstockto/phergie-irc-plugin-react-magic-eightball/badges/gpa.svg)](https://codeclimate.com/github/dstockto/phergie-irc-plugin-react-magic-eightball)

## Install

The recommended method of installation is [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "phergie/phergie-irc-plugin-react-magic-eight-ball": "dev-master"
    }
}
```

See Phergie documentation for more information on
[installing and enabling plugins](https://github.com/phergie/phergie-irc-bot-react/wiki/Usage#plugins).

## Configuration

The Magic Eightball plugin requires a response provider with the AnswerProvider interface. The EightballProvider comes
with the plugin but you can provide your own class if you want to provide different answers.

```php
new \Phergie\Irc\Plugin\React\MagicEightBall\Plugin()
```

By default, the Plugin will provide \Phergie\Irc\Plugin\React\MagicEightBall\EightballProvider() if you do not 
specify a provider. You can also create your own provider and send it into the plugin to get different responses.

```php
new \Phergie\Irc\Plugin\React\MagicEightBall\Plugin(
    new \Phergie\Irc\Plugin\React\MagicEightBall\EightballProvider() // Replace with your own provider
)
```


## Tests

To run the unit test suite:

```
curl -s https://getcomposer.org/installer | php
php composer.phar install
./vendor/bin/phpunit
```

## License

Released under the BSD License. See `LICENSE`.
