<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

final class PipsumProvider implements ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string
    {
        return 'http://pipsum.com/'.$width.'x'.$height.'.jpg';
    }

    public function getName(): string
    {
        return 'pipsum';
    }
}
