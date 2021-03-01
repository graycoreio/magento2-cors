# Magento 2 CORS

[![Packagist Downloads](https://img.shields.io/packagist/dm/graycore/magento2-cors?color=blue)](https://packagist.org/packages/graycore/magento2-cors/stats)
[![Packagist Version](https://img.shields.io/packagist/v/graycore/magento2-cors?color=blue)](https://packagist.org/packages/graycore/magento2-cors)
[![Packagist License](https://img.shields.io/packagist/l/graycore/magento2-cors)](https://github.com/graycoreio/magento2-cors/blob/master/LICENSE)
[![Build Status](https://graycore.visualstudio.com/open-source/_apis/build/status/graycoreio.magento2-cors?branchName=master)](https://graycore.visualstudio.com/open-source/_build/latest?definitionId=14&branchName=master)

## Magento Version Support
![Magento v2.3 Supported](https://img.shields.io/badge/Magento-2.3-brightgreen.svg?labelColor=2f2b2f&logo=magento&logoColor=f26724&color=464246&longCache=true&style=flat)
![Magento v2.4 Supported](https://img.shields.io/badge/Magento-2.4-brightgreen.svg?labelColor=2f2b2f&logo=magento&logoColor=f26724&color=464246&longCache=true&style=flat)

Ever try to work with the Magento GraphQL API or REST API from your browser and see the following?

```txt
Access to XMLHttpRequest at 'https://my.magento.app' from origin 'http://my.webapp.com' has been blocked by CORS policy: Response to preflight request doesn't pass access control check: No 'Access-Control-Allow-Origin' header is present on the requested resource.
```

This package allows you to securely add the necessary CORS headers to the Magento 2 GraphQL or REST APIs with ease.

## Purpose
When building a headless application for Magento, or working with a client that respects the CORS protocol, you will need [CORS headers](https://fetch.spec.whatwg.org/#http-cors-protocol) on your backend resource.

This package will add configurable CORS Resource headers to the Magento 2 GraphQL or REST APIs, allowing you to access the GraphQL or REST APIs from your browser.

## Getting Started
This module is intended to be installed with [composer](https://getcomposer.org/). From the root of your Magento 2 project:

1. Download the package
```bash
composer require graycore/magento2-cors
```
2. [Configure the package](/docs/stories/configuring-the-headers.md)
3. Enable the package

```bash
./bin/magento module:enable Graycore_Cors
```

## Features
* [Configurable](./docs/stories/configuring-the-headers.md)
* [Respects the full CORS Protocol](https://fetch.spec.whatwg.org/#http-cors-protocol)
    * `Access-Control-Allow-Origin`
    * `Access-Control-Allow-Methods`
    * `Access-Control-Allow-Headers`
    * `Access-Control-Max-Age`
    * `Access-Control-Expose-Headers`
    * `Access-Control-Allow-Credentials`

* [Security By Default](./docs/stories/security.md#security-by-default)
* [Vary: Origin](https://fetch.spec.whatwg.org/#cors-protocol-and-http-caches)
## Helpful Links
* [FAQ](./docs/faq/faqs.md)
    * [Can I configure this from the admin panel?](./docs/faq/faqs.md#can-i-configure-this-from-the-admin-panel)

## Upgrading
* [Semver Policy](https://semver.org/)
* [Guide](./docs/upgrading/guide.md)
