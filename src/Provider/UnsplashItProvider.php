<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

final class UnsplashItProvider implements ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string
    {
        return 'https://unsplash.it/'.$width.'/'.$height;
    }

    public function getName(): string
    {
        return 'unsplash';
    }
}
