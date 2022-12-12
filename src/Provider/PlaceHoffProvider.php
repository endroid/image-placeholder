<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

final class PlaceHoffProvider implements ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string
    {
        return 'http://place-hoff.com/'.$width.'/'.$height;
    }

    public function getName(): string
    {
        return 'placehoff';
    }
}
