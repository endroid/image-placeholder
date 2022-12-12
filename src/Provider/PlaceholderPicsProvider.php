<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

final class PlaceholderPicsProvider implements ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string
    {
        if (!isset($options['text'])) {
            $options['text'] = '';
        }

        return 'https://placeholder.pics/svg/'.$width.'x'.$height.'/DEDEDE/555555/'.$options['text'];
    }

    public function getName(): string
    {
        return 'placeholderpics';
    }
}
