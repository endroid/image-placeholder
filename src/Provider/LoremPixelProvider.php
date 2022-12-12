<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

final class LoremPixelProvider implements ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string
    {
        $url = 'https://lorempixel.com/'.$width.'/'.$height.'/';

        if (isset($options['category'])) {
            $url .= $options['category'].'/';
        }

        return $url;
    }

    public function getName(): string
    {
        return 'lorempixel';
    }
}
