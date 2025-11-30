# silasjoisten/sonata-oauth2-login-bundle 

[![Build Status](https://travis-ci.org/silasjoisten/sonata-oauth2-login-bundle.svg?branch=master)](https://travis-ci.org/silasjoisten/sonata-oauth2-login-bundle)
[![Latest Stable Version](https://poser.pugx.org/silasjoisten/sonata-oauth2-login-bundle/v/stable)](https://packagist.org/packages/silasjoisten/sonata-oauth2-login-bundle)
[![Total Downloads](https://poser.pugx.org/silasjoisten/sonata-oauth2-login-bundle/downloads)](https://packagist.org/packages/silasjoisten/sonata-oauth2-login-bundle)
[![Latest Unstable Version](https://poser.pugx.org/silasjoisten/sonata-oauth2-login-bundle/v/unstable)](https://packagist.org/packages/silasjoisten/sonata-oauth2-login-bundle)
[![License](https://poser.pugx.org/silasjoisten/sonata-oauth2-login-bundle/license)](https://packagist.org/packages/silasjoisten/sonata-oauth2-login-bundle)

This bundle is compatible with Symfony 6.4 and 7.4.

## Installation

```console
composer require silasjoisten/sonata-oauth2-login-bundle hwi/oauth-bundle http/http
```

### Enable the bundle (Symfony Flex)

If you're using Symfony Flex (Symfony 4+), the bundle will be auto-registered. If not, add it to `config/bundles.php`:

```php
return [
    // ...
    HWI\Bundle\OAuthBundle\HWIOAuthBundle::class => ['all' => true],
    SilasJoisten\Sonata\Oauth2LoginBundle\SonataOauth2LoginBundle::class => ['all' => true],
];
```

## Configuration

### Include the routing

`config/routes/sonata_oauth2_login.yaml`:

```yaml
SonataOauth2LoginBundle:
    resource: "@SonataOauth2LoginBundle/Resources/config/routing.xml"
```

### Configure the bundle

`config/packages/sonata_oauth2_login.yaml`:

```yaml
sonata_oauth2_login:
    valid_email_domains: ["@your-domain.com"]
    default_user_roles: ["ROLE_SONATA_ADMIN"]
    # optional
    custom_emails:
        test@example.com: ["ROLE_SUPER_ADMIN"]
        test2@example.de: ["ROLE_SONATA_ADMIN"]
```

_You can add as many valid domains as you want_

### Configure HWIOAuthBundle (Symfony 6/7 security)

`config/packages/security.yaml` (example):

```yaml
security:
    providers:
        hwi_provider:
            id: sonata_oauth2_login.user.provider

    firewalls:
        main:
            # if you protect only /admin with SonataAdmin, configure your firewall accordingly
            oauth:
                resource_owners:
                    google: "/login/check-google"
                login_path: /admin/login           # for Sonata Admin
                default_target_path: /admin/dashboard
                failure_path: /admin/login
                oauth_user_provider:
                    service: sonata_oauth2_login.user.provider

hwi_oauth:
    firewall_names: [main]
    resource_owners:
        google:
            type: google
            client_id: "YOUR_CLIENT_ID"
            client_secret: "YOUR_CLIENT_SECRET"
            scope: "email profile"
            options:
                csrf: true
                access_type: offline
```

## Usage

Render the login button in your Twig template:

```twig
{{ render_login_button() }}
```

Optional: You can pass an array to set custom `class` and `value`.

## Look and Feel

![Look and Feel](docs/screenshot.png)
