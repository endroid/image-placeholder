<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

final class BaconMockupProvider implements ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string
    {
        return 'https://baconmockup.com/'.$width.'/'.$height.'/';
    }

    public function getName(): string
    {
        return 'baconmockup';
    }
}
