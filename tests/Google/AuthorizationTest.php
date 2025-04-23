<?php

namespace SilasJoisten\Sonata\Oauth2LoginBundle\Tests\Google;

use Google\Client;
use PHPUnit\Framework\TestCase;
use SilasJoisten\Sonata\Oauth2LoginBundle\Google\Authorization;

class AuthorizationTest extends TestCase
{
    public function testGetClient(): void
    {
        $client = $this->createMock(Client::class);
        $client->expects($this->once())->method('setAccessType');

        $authorization = new Authorization($client);
        $googleClient = $authorization->getClient();

        $this->assertInstanceOf(Client::class, $googleClient);
    }
}
