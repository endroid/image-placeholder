Image Placeholder Bundle
========================

*By [endroid](http://endroid.nl/)*

[![Latest Stable Version](http://img.shields.io/packagist/v/endroid/image-placeholder-bundle.svg)](https://packagist.org/packages/endroid/image-placeholder-bundle)
[![Build Status](http://img.shields.io/travis/endroid/EndroidImagePlaceholderBundle.svg)](http://travis-ci.org/endroid/EndroidImagePlaceholderBundle)
[![Latest Stable Version](https://poser.pugx.org/endroid/image-placeholder-bundle/v/stable.png)](https://packagist.org/packages/endroid/image-placeholder-bundle)
[![Total Downloads](http://img.shields.io/packagist/dt/endroid/image-placeholder-bundle.svg)](https://packagist.org/packages/endroid/image-placeholder-bundle)
[![License](http://img.shields.io/packagist/l/endroid/image-placeholder-bundle.svg)](https://packagist.org/packages/endroid/image-placeholder-bundle)

Provides a Twig filter that replaces empty or invalid URLs with a placeholder
image. Multiple image providers are available.

[![knpbundles.com](http://knpbundles.com/endroid/EndroidImagePlaceholderBundle/badge-short)](http://knpbundles.com/endroid/EndroidImagePlaceholderBundle)

## Requirements

* Symfony
* Dependencies: none

## Installation

Use [Composer](https://getcomposer.org/) to install the bundle.

``` bash
$ composer require endroid/image-placeholder-bundle
```

Then enable the bundle via the kernel.

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Endroid\Bundle\ImagePlaceholderBundle\EndroidImagePlaceholderBundle(),
    );
}
```

## Configuration

The default placeholder generation parameters can be overridden via the
configuration. All parameters are optional.

### config.yml

```yaml
endroid_image_placeholder:
    enabled: %kernel.debug%
    provider: placehold.it
    check_image_exists: true
```

## Usage

Placeholders are placed via a Twig filter that shows the placeholder image in
case the bundle is activated and the given URL is empty or invalid.

``` twig
<img src="{{ image_url|image_placeholder(200, 300) }}" />
<img src="{{ image_url|image_placeholder(200, 300, { provider: 'unsplash_it' }) }}" />
```

## Versioning

Version numbers follow the MAJOR.MINOR.PATCH scheme. Backwards compatible
changes will be kept to a minimum but be aware that these can occur. Lock
your dependencies for production and test your code when upgrading.

## License

This bundle is under the MIT license. For the full copyright and license
information please view the LICENSE file that was distributed with this source code.
