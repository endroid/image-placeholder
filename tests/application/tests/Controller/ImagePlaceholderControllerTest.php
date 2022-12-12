<?php

declare(strict_types=1);

namespace Endroid\ImagePlaceholder\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImagePlaceholderControllerTest extends WebTestCase
{
    public function testDemoController()
    {
        $client = static::createClient();

        $client->request('GET', '/image-placeholder');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('data:image/png;base64,', $client->getResponse()->getContent());
    }
}
