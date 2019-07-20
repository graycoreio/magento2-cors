# Magento 2 CORS 
Ever try to work with the Magento v2.3+ GraphQL API from your browser and see the following?

```txt
Access to XMLHttpRequest at 'https://my.magento.app' from origin 'http://my.local.env' has been blocked by CORS policy: Response to preflight request doesn't pass access control check: No 'Access-Control-Allow-Origin' header is present on the requested resource.
```

This package allows you to add the necessary CORS headers to Magento 2 with ease.

## Purpose
When building a headless application for Magento, or working with a client that respects the CORS protocol, you will need [CORS headers](https://fetch.spec.whatwg.org/#http-cors-protocol) on your backend resource.

This package will add configurable CORS Resource headers to the Magento 2 GraphQL API, allowing you to access the GraphQL API from your browser.

## Getting Started
This module is intended to be installed with [composer](https://getcomposer.org/). From the root of your Magento 2 project, run the following commands:

```bash
composer require graycore/magento2-cors
./bin/magento module:enable Graycore_Cors
```

Next, [follow along with the configuration story](/docs/stories/configuring-the-headers.md) to configure the package.

## Features
* [Configurable](./docs/stories/configuring-the-headers.md)
* [Respects the full CORS Protocol](https://fetch.spec.whatwg.org/#http-cors-protocol)
    * `Access-Control-Allow-Origin`
    * `Access-Control-Allow-Methods`
    * `Access-Control-Allow-Headers`
    * `Access-Control-Max-Age`
* [Security By Default](./docs/stories/security.md#security-by-default)

## Helpful Links
* :question: [FAQ](./docs/faq/faqs.md)
    * [Can I configure this from the admin panel?](./docs/faq/faqs.md#can-i-configure-this-from-the-admin-panel)