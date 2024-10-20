<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Twig\Extension;

use Endroid\ImagePlaceholder\ImagePlaceholder;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class ImagePlaceholderExtension extends AbstractExtension
{
    public function __construct(
        private readonly ImagePlaceholder $imagePlaceholder,
    ) {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('image_placeholder', [$this, 'imagePlaceholderFilter']),
        ];
    }

    /** @param array<string> $options */
    public function imagePlaceholderFilter(?string $url, int $width, int $height, array $options = []): string
    {
        return $this->imagePlaceholder->getUrl($url, $width, $height, $options);
    }

    public function getName(): string
    {
        return 'image_placeholder_extension';
    }
}
