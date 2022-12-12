<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Provider;

interface ProviderInterface
{
    /** @param array<mixed> $options */
    public function getUrl(int $width, int $height, array $options = []): string;

    public function getName(): string;
}
