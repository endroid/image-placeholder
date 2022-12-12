<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

final class LoremFlickrProvider implements ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string
    {
        return 'https://loremflickr.com/'.$width.'/'.$height.'/';
    }

    public function getName(): string
    {
        return 'loremflickr';
    }
}
