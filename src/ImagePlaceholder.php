<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder;

final readonly class ImagePlaceholder
{
    final public const string OPTION_CHECK_IMAGE_EXISTS = 'check_image_exists';

    /**
     * @param int<1, max>          $width
     * @param int<1, max>          $height
     * @param array<string, mixed> $options
     */
    public function getUrl(?string $url, int $width, int $height, array $options = []): string
    {
        // @mago-ignore analysis:mixed-operand
        $checkImageExists = (bool) ($options[self::OPTION_CHECK_IMAGE_EXISTS] ?? true);

        $url = trim(strval($url));
        if ('' !== $url) {
            if (!$checkImageExists) {
                return $url;
            }

            if (false !== filter_var($url, FILTER_VALIDATE_URL)) {
                return $url;
            }
        }

        if (!extension_loaded('gd')) {
            throw new \Exception(
                'Unable to generate image: please check if the GD extension is enabled and configured correctly',
            );
        }

        $baseImage = imagecreatetruecolor($width, $height);

        if (!$baseImage) {
            throw new \Exception(
                'Unable to generate image: please check if the GD extension is enabled and configured correctly',
            );
        }

        // Determine text parameters
        $text = $width . ' x ' . $height;
        /** @var array<int> $labelBox */
        $labelBox = imagettfbbox(
            size: 10,
            angle: 0,
            font_filename: __DIR__ . '/../assets/open_sans.ttf',
            string: $text,
        );
        $textWidth = ($labelBox[2] ?? 0) - ($labelBox[0] ?? 0);
        $textHeight = ($labelBox[1] ?? 0) - ($labelBox[7] ?? 0);
        $textX = intval((imagesx($baseImage) / 2) - ($textWidth / 2));
        $textY = intval((imagesy($baseImage) / 2) - ($textHeight / 2));

        /** @var int<0, max> $backgroundColor */
        $backgroundColor = imagecolorallocatealpha($baseImage, red: 150, green: 150, blue: 150, alpha: 0);
        imagefill($baseImage, x: 0, y: 0, color: $backgroundColor);

        /** @var int<0, max> $textColor */
        $textColor = imagecolorallocatealpha($baseImage, red: 50, green: 50, blue: 50, alpha: 0);
        imagettftext(
            $baseImage,
            size: 10,
            angle: 0,
            x: $textX,
            y: $textY,
            color: $textColor,
            font_filename: __DIR__ . '/../assets/open_sans.ttf',
            text: $text,
        );

        ob_start();
        imagepng($baseImage);
        $imageData = ob_get_clean();
        if (!is_string($imageData) || !str_contains($imageData, 'PNG')) {
            throw new \Exception(
                'Unable to generate image: please check if the GD extension is enabled and configured correctly',
            );
        }

        return 'data:image/png;base64,' . base64_encode($imageData);
    }
}
