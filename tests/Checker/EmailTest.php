<?php

namespace SilasJoisten\Sonata\Oauth2LoginBundle\Tests\Checker;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SilasJoisten\Sonata\Oauth2LoginBundle\Checker\Email;

class EmailTest extends TestCase
{
    #[DataProvider('isEmailValidProvider')]
    public function testIsEmailValid($expected, $email): void
    {
        $validEmailDomains = [
            '@hotmail.de',
            '@gmail.com',
            '@example.com',
        ];

        $checker = new Email($validEmailDomains);

        $this->assertSame($expected, $checker->isEmailValid($email));
    }

    public static function isEmailValidProvider(): array
    {
        return [
            [true, 'test@hotmail.de'],
            [true, 'test@gmail.com'],
            [true, 'test@example.com'],
            [false, 'test@hotmail.com'],
            [false, 'test@foobar.de'],
            [false, 'test@gmail.de'],
            [false, 'test@example.de'],
            [false, 'test@test.de'],
        ];
    }

    #[DataProvider('hasCustomRolesProvider')]
    public function testHasCustomRoles($expected, $email): void
    {
        $customEmails = [
            'bar.foo@goo.de' => 'ROLE_SUPER_ADMIN',
            'test@example.com' => 'ROLE_SONATA_ADMIN',
        ];

        $checker = new Email([], $customEmails);

        $this->assertSame($expected, $checker->hasCustomRoles($email));
    }

    public static function hasCustomRolesProvider(): array
    {
        return [
            [true, 'bar.foo@goo.de'],
            [false, 'test@gmail.com'],
            [true, 'test@example.com'],
            [false, 'test@hotmail.com'],
            [false, 'test@foobar.de'],
            [false, 'test@gmail.de'],
            [false, 'test@example.de'],
            [false, 'test@test.de'],
        ];
    }

    #[DataProvider('getCustomRolesProvider')]
    public function testGetCustomRoles($expected, $email): void
    {
        $customEmails = [
            'bar.foo@goo.de' => ['ROLE_SUPER_ADMIN'],
            'test@example.com' => ['ROLE_SONATA_ADMIN'],
            'some@email.com' => ['ROLE_USER_MANAGER', 'ROLE_SONATA_ADMIN'],
        ];

        $checker = new Email([], $customEmails);

        $this->assertSame($expected, $checker->getCustomRoles($email));
    }

    public static function getCustomRolesProvider(): array
    {
        return [
            [['ROLE_SUPER_ADMIN'], 'bar.foo@goo.de'],
            [[], 'test@gmail.com'],
            [['ROLE_SONATA_ADMIN'], 'test@example.com'],
            [[], 'test@hotmail.com'],
            [[], 'test@foobar.de'],
            [[], 'test@gmail.de'],
            [[], 'test@example.de'],
            [[], 'test@test.de'],
            [['ROLE_USER_MANAGER', 'ROLE_SONATA_ADMIN'], 'some@email.com'],
        ];
    }
}
