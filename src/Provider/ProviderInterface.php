<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\ImagePlaceholderBundle\Provider;

interface ProviderInterface
{
    /**
     * Returns an image URL.
     *
     * @param int   $width
     * @param int   $height
     * @param array $options
     *
     * @return mixed
     */
    public function getUrl($width, $height, array $options = array());

    /**
     * Returns the provider name.
     *
     * @return mixed
     */
    public function getName();
}
