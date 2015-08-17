<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\ImagePlaceholderBundle\Twig\Extension;

use Endroid\Bundle\ImagePlaceholderBundle\Provider\ProviderInterface;
use Symfony\Component\Security\Core\Exception\ProviderNotFoundException;

class ImagePlaceholderService
{
    /**
     * @var string
     */
    protected $providerName;

    /**
     * @var bool
     */
    protected $checkImageExists;

    /**
     * @var ProviderInterface[]
     */
    protected $providers;

    /**
     * Creates a new instance.
     *
     * @param string $providerName
     * @param bool   $checkImageExists
     */
    public function __construct($providerName, $checkImageExists)
    {
        $this->providerName = $providerName;
        $this->checkImageExists = $checkImageExists;
        $this->providers = array();
    }

    /**
     * Registers a provider for the placeholder service.
     *
     * @param ProviderInterface $provider
     */
    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[$provider->getName()] = $provider;
    }

    /**
     * Checks if the image URL is valid.
     *
     * @param string $url
     *
     * @return bool
     */
    public function isValidImageUrl($url)
    {
        if (!$url) {
            return false;
        }

        if ($this->checkImageExists && !$this->imageExists($url)) {
            return false;
        }

        return true;
    }

    /**
     * Checks if an image exists at the URL.
     *
     * @param string $url
     *
     * @return bool
     */
    protected function imageExists($url)
    {
        $contents = @file_get_contents($url);

        return ($contents);
    }

    /**
     * Returns a placeholder URL.
     *
     * @param int   $width
     * @param int   $height
     * @param array $options
     *
     * @return string
     *
     * @throws ProviderNotFoundException
     */
    public function getUrl($width, $height, array $options = array())
    {
        $providerName = $this->providerName;
        if (isset($options['provider'])) {
            $providerName = $options['provider'];
        }

        if (!array_key_exists($providerName, $this->providers)) {
            throw new ProviderNotFoundException($providerName);
        }

        return $this->providers[$providerName]->getUrl($width, $height, $options);
    }
}
