<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\ImagePlaceholder;

use Endroid\ImagePlaceholder\Exception\ProviderNotFoundException;
use PHPUnit\Framework\TestCase;

class ImagePlaceholderTest extends TestCase
{
    public function testCreate()
    {
        $imagePlaceholder = new ImagePlaceholder();

        $this->expectException(ProviderNotFoundException::class);
        
        $imagePlaceholder->getUrl('', 200, 200);
    }
}
