<?php

namespace SilasJoisten\Sonata\Oauth2LoginBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use SilasJoisten\Sonata\Oauth2LoginBundle\DependencyInjection\SonataOauth2LoginExtension;

/**
 * @group di
 */
class SonataOauth2LoginExtensionTest extends AbstractExtensionTestCase
{
    #[DataProvider('combinedServicesProvider')]
    public function testAvailableServices($service): void
    {
        $this->load();

        $this->assertContainerBuilderHasService($service);
    }

    public static function availableSecurityProvider(): array
    {
        return [
            ['sonata_oauth2_login.google.authorization'],
        ];
    }

    public static function availableServicesProvider(): array
    {
        return [
            ['sonata_oauth2_login.checker.email'],
            ['sonata_oauth2_login.user.provider'],
            ['sonata_oauth2_login.google.client'],
        ];
    }

    public static function availableTwigExtensionsProvider(): array
    {
        return [
            ['sonata_oauth2_login.twig.render_button_extension'],
        ];
    }

    public static function combinedServicesProvider(): array
    {
        return array_merge(
            self::availableSecurityProvider(),
            self::availableServicesProvider(),
            self::availableTwigExtensionsProvider()
        );
    }

    protected function getContainerExtensions(): array
    {
        return [
            new SonataOauth2LoginExtension(),
        ];
    }
}
