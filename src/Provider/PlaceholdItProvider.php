<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\ImagePlaceholderBundle\Provider;

class PlaceholdItProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUrl($width, $height, array $options = [])
    {
        $url = 'http://placehold.it/'.$width.'x'.$height;

        return $url;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'placehold';
    }
}
