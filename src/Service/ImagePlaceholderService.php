<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholderBundle\Service;

use Endroid\ImagePlaceholderBundle\Provider\ProviderInterface;
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
     * @var bool
     */
    protected $enabled;

    /**
     * @var ProviderInterface[]
     */
    protected $providers;

    /**
     * Creates a new instance.
     */
    public function __construct()
    {
        $this->enabled = true;
        $this->checkImageExists = false;
        $this->providers = [];
    }

    /**
     * Sets the provider name.
     *
     * @param string $providerName
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;
    }

    /**
     * Sets the service to active / inactive.
     *
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Determines if the image resource should be checked.
     *
     * @param $checkImageExists
     */
    public function setCheckImageExists($checkImageExists)
    {
        $this->checkImageExists = $checkImageExists;
    }

    /**
     * Registers a provider for the placeholder service.
     *
     * @param ProviderInterface $provider
     */
    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[$provider->getName()] = $provider;

        if (!$this->providerName && count($this->providers) == 1) {
            $this->providerName = $provider->getName();
        }
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
        if (!$this->enabled) {
            return $url;
        }

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

        return $contents;
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
    public function getUrl($width, $height, array $options = [])
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
