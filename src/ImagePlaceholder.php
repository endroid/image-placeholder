<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholder;

use Endroid\ImagePlaceholder\Exception\ProviderNotFoundException;
use Endroid\ImagePlaceholder\Provider\ProviderInterface;

class ImagePlaceholder
{
    private $enabled;
    private $providerName;
    private $checkImageExists;
    private $providers;

    public function __construct(bool $enabled = true, string $providerName = null, bool $checkImageExists = false)
    {
        $this->enabled = $enabled;
        $this->providerName = $providerName;
        $this->checkImageExists = $checkImageExists;

        $this->providers = [];
    }

    public function setProvider(string $providerName): void
    {
        $this->providerName = $providerName;
    }

    public function addProviders(iterable $providers)
    {
        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }
    }

    public function addProvider(ProviderInterface $provider): void
    {
        $this->providers[$provider->getName()] = $provider;
    }

    protected function imageExists($url)
    {
        $contents = @file_get_contents($url);

        return false !== $contents;
    }

    public function getUrl(string $url, int $width, int $height, array $options = []): string
    {
        $providerName = $this->providerName;
        if (isset($options['provider'])) {
            $providerName = $options['provider'];
            unset($options['provider']);
        }

        $checkImageExists = $this->checkImageExists;
        if (isset($options['check_image_exists'])) {
            $checkImageExists = $options['check_image_exists'];
            unset($options['check_image_exists']);
        }

        if (!$checkImageExists && strlen($url) > 0) {
            return $url;
        }

        if ($checkImageExists && $this->imageExists($url)) {
            return $url;
        }

        return $this->getProvider($providerName)->getUrl($width, $height, $options);
    }

    private function getProvider(string $providerName = null): ProviderInterface
    {
        if (null === $providerName) {
            $providerName = $this->providerName;
        }

        if (!array_key_exists($providerName, $this->providers)) {
            throw new ProviderNotFoundException(strval($providerName));
        }

        return $this->providers[$providerName];
    }
}
