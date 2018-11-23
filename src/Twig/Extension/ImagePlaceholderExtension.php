<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholder\Twig\Extension;

use Endroid\ImagePlaceholder\ImagePlaceholder;
use Twig_Extension;
use Twig_SimpleFilter;

class ImagePlaceholderExtension extends Twig_Extension
{
    private $imagePlaceholder;

    public function __construct(ImagePlaceholder $imagePlaceholder)
    {
        $this->imagePlaceholder = $imagePlaceholder;
    }

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('image_placeholder', [$this, 'imagePlaceholderFilter']),
        ];
    }

    public function imagePlaceholderFilter(string $url, int $width, int $height, array $options = []): string
    {
        return $this->imagePlaceholder->getUrl($url, $width, $height, $options);
    }

    public function getName()
    {
        return 'image_placeholder_extension';
    }
}
