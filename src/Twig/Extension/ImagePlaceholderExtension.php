<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholderBundle\Twig\Extension;

use Endroid\ImagePlaceholderBundle\Service\ImagePlaceholderService;
use Twig_Extension;
use Twig_SimpleFilter;

class ImagePlaceholderExtension extends Twig_Extension
{
    /**
     * @var ImagePlaceholderService
     */
    protected $imagePlaceholderService;

    /**
     * Creates a new instance.
     *
     * @param ImagePlaceholderService $imagePlaceholderService
     */
    public function __construct(ImagePlaceholderService $imagePlaceholderService)
    {
        $this->imagePlaceholderService = $imagePlaceholderService;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('image_placeholder', [$this, 'imagePlaceholderFilter']),
        ];
    }

    /**
     * Replaces the image URL with the placeholder URL when needed.
     *
     * @param string $url
     * @param int    $width
     * @param int    $height
     * @param array  $options
     *
     * @return string
     */
    public function imagePlaceholderFilter($url, $width, $height, array $options = [])
    {
        if ($this->imagePlaceholderService->isValidImageUrl($url)) {
            return $url;
        }

        return $this->imagePlaceholderService->getUrl($width, $height, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'image_placeholder_extension';
    }
}
