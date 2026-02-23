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
    ) {}

    /**
     * @return TwigFilter[]
     * @phpstan-return array<TwigFilter>
     */
    #[\Override]
    public function getFilters(): array
    {
        return [
            new TwigFilter('image_placeholder', [$this, 'imagePlaceholderFilter']),
        ];
    }

    /**
     * @param int<1, max>   $width
     * @param int<1, max>   $height
     * @param array<string, mixed> $options
     */
    public function imagePlaceholderFilter(?string $url, int $width, int $height, array $options = []): string
    {
        return $this->imagePlaceholder->getUrl($url, $width, $height, $options);
    }
}
