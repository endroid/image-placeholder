<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder;

use Endroid\ImagePlaceholder\Exception\ProviderNotFoundException;
use Endroid\ImagePlaceholder\Provider\ProviderInterface;

final class ImagePlaceholder
{
    public const OPTION_PROVIDERS = 'providers';
    public const OPTION_CHECK_IMAGE_EXISTS = 'check_image_exists';

    public function __construct(
        /** @var array<string, ProviderInterface> $providers */
        private array $providers
    ) {
    }

    /** @param array<mixed> $options */
    public function getUrl(string $url, int $width, int $height, array $options = []): string
    {
        $providers = $options[self::OPTION_PROVIDERS] ?? array_keys($this->providers);
        $checkImageExists = $options[self::OPTION_CHECK_IMAGE_EXISTS] ?? false;

        if (!$checkImageExists && strlen($url) > 0) {
            return $url;
        }

        if ($checkImageExists && false !== @file_get_contents($url)) {
            return $url;
        }

        shuffle($providers);

        if (!isset($this->providers[$providers[0]])) {
            throw new ProviderNotFoundException(sprintf('Provider "%s" not found', $providers[0]));
        }

        return $this->providers[$providers[0]]->getUrl($width, $height, $options);
    }
}
