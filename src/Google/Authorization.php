<?php

namespace SilasJoisten\Sonata\Oauth2LoginBundle\Google;

use Google\Client;

final class Authorization
{
    public function __construct(
        private Client $client,
    ) {
    }

    public function getClient(): Client
    {
        $this->client->setAccessType('offline');

        return $this->client;
    }
}
