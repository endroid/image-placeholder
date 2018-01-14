<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholder\Provider;

class LoremPixelProvider implements ProviderInterface
{
    public function getUrl($width, $height, array $options = []): string
    {
        $url = 'http://lorempixel.com/'.$width.'/'.$height.'/';

        if (isset($options['category'])) {
            $url .= $options['category'].'/';
        }

        return $url;
    }

    public function getName(): string
    {
        return 'lorempixel';
    }
}
