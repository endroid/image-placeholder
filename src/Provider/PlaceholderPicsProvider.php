<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholder\Provider;

final class PlaceholderPicsProvider implements ProviderInterface
{
    public function getUrl($width, $height, array $options = []): string
    {
        if (!isset($options['text'])) {
            $options['text'] = '';
        }

        $url = 'https://placeholder.pics/svg/'.$width.'x'.$height.'/DEDEDE/555555/'.$options['text'];

        return $url;
    }

    public function getName(): string
    {
        return 'placeholderpics';
    }
}
