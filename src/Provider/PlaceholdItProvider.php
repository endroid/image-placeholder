<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

final class PlaceholdItProvider implements ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string
    {
        return 'https://placehold.it/'.$width.'x'.$height;
    }

    public function getName(): string
    {
        return 'placehold';
    }
}
