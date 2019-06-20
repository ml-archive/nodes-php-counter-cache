## Counter Cache

** This package is deprecated ** 

Brings the ruby concept of "counter caching" to [Laravel](http://laravel.com/docs).

[![Total downloads](https://img.shields.io/packagist/dt/nodes/counter-cache.svg)](https://packagist.org/packages/nodes/counter-cache)
[![Monthly downloads](https://img.shields.io/packagist/dm/nodes/counter-cache.svg)](https://packagist.org/packages/nodes/counter-cache)
[![Latest release](https://img.shields.io/packagist/v/nodes/counter-cache.svg)](https://packagist.org/packages/nodes/counter-cache)
[![Open issues](https://img.shields.io/github/issues/nodes-php/counter-cache.svg)](https://github.com/nodes-php/counter-cache/issues)
[![License](https://img.shields.io/packagist/l/nodes/counter-cache.svg)](https://packagist.org/packages/nodes/counter-cache)
[![Star repository on GitHub](https://img.shields.io/github/stars/nodes-php/counter-cache.svg?style=social&label=Star)](https://github.com/nodes-php/counter-cache/stargazers)
[![Watch repository on GitHub](https://img.shields.io/github/watchers/nodes-php/counter-cache.svg?style=social&label=Watch)](https://github.com/nodes-php/counter-cache/watchers)
[![Fork repository on GitHub](https://img.shields.io/github/forks/nodes-php/counter-cache.svg?style=social&label=Fork)](https://github.com/nodes-php/counter-cache/network)
[![StyleCI](https://styleci.io/repos/47500408/shield)](https://styleci.io/repos/47500408)

## 📝 Introduction

One thing we at [Nodes](http://nodesagency.com) have been missing in [Laravel](http://laravel.com/docs) is the concept of "counter caching".

Laravel comes "out of the box" with the [increment](http://laravel.com/docs/5.1/queries#updates)/[decrement](http://laravel.com/docs/5.1/queries#updates) methods on it's [Eloquent](http://laravel.com/docs/5.1/eloquent) models. But you'll need to manually execute these methods everytime, you've saved/delete stuff with your model.

Since the [increment](http://laravel.com/docs/5.1/queries#updates)/[decrement](http://laravel.com/docs/5.1/queries#updates) methods always +1/-1, you can't 100% rely on these as cached value.
What if you forgot to execute the decrement method when you deleted a row. Or what if someone deleted a row directly from the database, then your count would be "out of sync".

Therefore we've created this package which brings "counter caching" to [Laravel](http://laravel.com/docs).

The difference between this package and Laravel's [increment](http://laravel.com/docs/5.1/queries#updates)/[decrement](http://laravel.com/docs/5.1/queries#updates) is that our package actually generates and fires a SQL count statement, that counts the entries and updates the desired column with the result.

This way you're always 100% sure that the value in your "counter cache" column is correct.

## 📦 Installation

To install this package you will need:

* Laravel 5.1+
* PHP 5.5.9+

You must then modify your `composer.json` file and run `composer update` to include the latest version of the package in your project.

```json
"require": {
    "nodes/counter-cache": "^1.0"
}
```

Or you can run the composer require command from your terminal.

```bash
composer require nodes/counter-cache:^1.0
```


## ⚙ Usage

Please refer to the [Wiki documentation](https://github.com/nodes-php/counter-cache/wiki) for more information.

## 🏆 Credits

This package is developed and maintained by the PHP team at [Nodes Agency](http://nodesagency.com)

[![Follow Nodes PHP on Twitter](https://img.shields.io/twitter/follow/nodesphp.svg?style=social)](https://twitter.com/nodesphp) [![Tweet Nodes PHP](https://img.shields.io/twitter/url/http/nodesphp.svg?style=social)](https://twitter.com/nodesphp)

## 📄 License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
