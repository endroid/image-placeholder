<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder;

final class ImagePlaceholder
{
    public const OPTION_CHECK_IMAGE_EXISTS = 'check_image_exists';

    /** @param array<string, mixed> $options */
    public function getUrl(string|null $url, int $width, int $height, array $options = []): string
    {
        $checkImageExists = $options[self::OPTION_CHECK_IMAGE_EXISTS] ?? true;

        $url = trim(strval($url));
        if ('' !== $url) {
            if ($checkImageExists) {
                if (false !== filter_var($url, FILTER_VALIDATE_URL)) {
                    return $url;
                }
            } else {
                return $url;
            }
        }

        if (!extension_loaded('gd')) {
            throw new \Exception('Unable to generate image: please check if the GD extension is enabled and configured correctly');
        }

        $baseImage = imagecreatetruecolor($width, $height);

        if (!$baseImage) {
            throw new \Exception('Unable to generate image: please check if the GD extension is enabled and configured correctly');
        }

        // Determine text parameters
        $text = $width.' x '.$height;
        /** @var array<int> $labelBox */
        $labelBox = imagettfbbox(10, 0, __DIR__.'/../assets/open_sans.ttf', $text);
        $textWidth = $labelBox[2] - $labelBox[0];
        $textHeight = $labelBox[1] - $labelBox[7];
        $textX = intval(imagesx($baseImage) / 2 - $textWidth / 2);
        $textY = intval(imagesy($baseImage) / 2 - $textHeight / 2);

        /** @var int $backgroundColor */
        $backgroundColor = imagecolorallocatealpha($baseImage, 150, 150, 150, 0);
        imagefill($baseImage, 0, 0, $backgroundColor);

        /** @var int $textColor */
        $textColor = imagecolorallocatealpha($baseImage, 50, 50, 50, 0);
        imagettftext($baseImage, 10, 0, $textX, $textY, $textColor, __DIR__.'/../assets/open_sans.ttf', $text);

        ob_start();
        imagepng($baseImage);
        $imageData = ob_get_clean();
        if (!is_string($imageData) || !str_contains($imageData, 'PNG')) {
            throw new \Exception('Unable to generate image: please check if the GD extension is enabled and configured correctly');
        }

        return 'data:image/png;base64,'.base64_encode($imageData);
    }
}
