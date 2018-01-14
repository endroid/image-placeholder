<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholder\Provider;

final class PlaceholdItProvider implements ProviderInterface
{
    public function getUrl($width, $height, array $options = []): string
    {
        $url = 'https://placehold.it/'.$width.'x'.$height;

        return $url;
    }

    public function getName(): string
    {
        return 'placehold';
    }
}
