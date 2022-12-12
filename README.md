# Image Placeholder

*By [endroid](https://endroid.nl/)*

[![Latest Stable Version](http://img.shields.io/packagist/v/endroid/image-placeholder.svg)](https://packagist.org/packages/endroid/image-placeholder)
[![Build Status](https://github.com/endroid/image-placeholder/workflows/CI/badge.svg)](https://github.com/endroid/image-placeholder/actions)
[![Total Downloads](http://img.shields.io/packagist/dt/endroid/image-placeholder.svg)](https://packagist.org/packages/endroid/image-placeholder)
[![Monthly Downloads](http://img.shields.io/packagist/dm/endroid/image-placeholder.svg)](https://packagist.org/packages/endroid/image-placeholder)
[![License](http://img.shields.io/packagist/l/endroid/image-placeholder.svg)](https://packagist.org/packages/endroid/image-placeholder)

Provides a Twig filter that replaces empty or invalid URLs with a placeholder image.

## Installation

Use [Composer](https://getcomposer.org/) to install the library.

``` bash
$ composer require endroid/image-placeholder
```

## Configuration

The default placeholder generation parameters can be overridden via the
constructor arguments or service definition. All parameters are optional.

## Usage

Placeholders are placed via a Twig filter that shows the placeholder image in
case the service is activated and the given URL is empty or invalid.

``` twig
<img src="{{ image_url|image_placeholder(200, 300) }}" />
<img src="{{ image_url|image_placeholder(200, 300, { check_image_exists: false }) }}" />
```

## Versioning

Version numbers follow the MAJOR.MINOR.PATCH scheme. Backwards compatibility
breaking changes will be kept to a minimum but be aware that these can occur.
Lock your dependencies for production and test your code when upgrading.

## License

This library is under the MIT license. For the full copyright and license
information please view the LICENSE file that was distributed with this source code.
