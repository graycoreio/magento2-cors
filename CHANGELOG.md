# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [2.1.0](https://github.com/graycoreio/magento2-cors/compare/v2.0.1...v2.1.0) (2024-10-10)


### Features

* **docs:** augment docs for configuring Commerce Cloud ([#87](https://github.com/graycoreio/magento2-cors/issues/87)) ([d9f7f69](https://github.com/graycoreio/magento2-cors/commit/d9f7f69b301ba9bcbfb03bca8d27254a6eb98601))

## [2.0.1](https://github.com/graycoreio/magento2-cors/compare/v2.0.0...v2.0.1) (2024-02-07)


### Bug Fixes

* `Access-Control-Expose-Headers` only set on preflight ([#84](https://github.com/graycoreio/magento2-cors/issues/84)) ([f2515c8](https://github.com/graycoreio/magento2-cors/commit/f2515c831641eeb9cc3dbefc082a14706158581b))
* wrong di.xml configuration - missing noNamespaceSchemaLocation and xmlns:xsi ([#82](https://github.com/graycoreio/magento2-cors/issues/82)) ([104fd5d](https://github.com/graycoreio/magento2-cors/commit/104fd5dcb3a1c00e83a06973719d4aa4683cdcc6))

## [2.0.0](https://github.com/graycoreio/magento2-cors/compare/v2.0.0-rc.0...v2.0.0) (2022-10-14)


### Bug Fixes

* add compatability between Laminas\Http and Zend\Http ([#75](https://github.com/graycoreio/magento2-cors/issues/75)) ([b1d4af1](https://github.com/graycoreio/magento2-cors/commit/b1d4af124b1a1a0f3ad19009a0eba5d9d973309f))

## [2.0.0-rc.0](https://github.com/graycoreio/magento2-cors/compare/v1.6.0...v2.0.0-rc.0) (2022-06-11)


### ⚠ BREAKING CHANGES

* If you were expecting to use the native GraphQl/REST controller when computing CORS headers (and everything else that entails - like having a Magento session, for example) that guarantee is no-longer provided.

### Features

* **graphql,rest:** add faster CORS headers ([#66](https://github.com/graycoreio/magento2-cors/issues/66)) ([cefd663](https://github.com/graycoreio/magento2-cors/commit/cefd6631d4f2aaf5347875a02d773317480783d5))


* denote breaking changes ([b98b9bc](https://github.com/graycoreio/magento2-cors/commit/b98b9bcfcefa533f84e85921a9becb5be2a9ff71))

## [1.6.0](https://github.com/graycoreio/magento2-cors/compare/v1.4.1...v1.6.0) (2022-06-11)


### Features

* add Magento v2.4.4 and PHP8.1 support ([#70](https://github.com/graycoreio/magento2-cors/issues/70)) ([6e8bfe1](https://github.com/graycoreio/magento2-cors/commit/6e8bfe184e47e602b26c001d986bb296d42c3665))
* **rest:** extend REST request to allow OPTIONS without error ([#55](https://github.com/graycoreio/magento2-cors/issues/55)) ([eb1df2d](https://github.com/graycoreio/magento2-cors/commit/eb1df2d0c25897897998e8e3f88fcec500a8a3f8))

### [1.4.1](https://github.com/graycoreio/magento2-cors/compare/v1.4.0...v1.4.1) (2021-03-04)


### Bug Fixes

* **graphql, rest:** allow caching of options requests ([#53](https://github.com/graycoreio/magento2-cors/issues/53)) ([f6b9b3f](https://github.com/graycoreio/magento2-cors/commit/f6b9b3fbf042d7c551b3993cca8e24a169309748))

## [1.4.0](https://github.com/graycoreio/magento2-cors/compare/v1.3.2...v1.4.0) (2021-03-02)


### Features

* **graphql, rest:** add support for access-control-expose-headers ([#49](https://github.com/graycoreio/magento2-cors/issues/49)) ([53aac87](https://github.com/graycoreio/magento2-cors/commit/53aac87f4397352426dc5b8eef720ca22a5594f6))
* **graphql, rest:** apply certain headers only to preflight requests ([#51](https://github.com/graycoreio/magento2-cors/issues/51)) ([30bcff0](https://github.com/graycoreio/magento2-cors/commit/30bcff0931134e56d0f4d4217bfe84dde1588b00))
* **graphql,rest:** add support for Vary header with Origin ([#47](https://github.com/graycoreio/magento2-cors/issues/47)) ([e656909](https://github.com/graycoreio/magento2-cors/commit/e65690922063d7e52e0cd6bbed8643dda4a3d061))
* **validator:** add a new method to determine whether or not a reque… ([#50](https://github.com/graycoreio/magento2-cors/issues/50)) ([8c3ef8b](https://github.com/graycoreio/magento2-cors/commit/8c3ef8b085c79dfd6aad8a6a3a725ade98e9490b))

### [1.3.2](https://github.com/graycoreio/magento2-cors/compare/v1.3.1...v1.3.2) (2020-08-10)

### [1.3.1](https://github.com/graycoreio/magento2-cors/compare/v1.3.0...v1.3.1) (2020-08-10)

## [1.3.0](https://github.com/graycoreio/magento2-cors/compare/v1.2.0...v1.3.0) (2020-05-18)


### Bug Fixes

* **graphql:** prevent fatal error when using Chrome extensions for graphql querying ([#24](https://github.com/graycoreio/magento2-cors/issues/24)) ([486fe10](https://github.com/graycoreio/magento2-cors/commit/486fe10))


### Build System

* **all:** added unit tests to CI ([#18](https://github.com/graycoreio/magento2-cors/issues/18)) ([aade441](https://github.com/graycoreio/magento2-cors/commit/aade441))
* **all:** adding linting with phpcs ([#16](https://github.com/graycoreio/magento2-cors/issues/16)) ([8753bd2](https://github.com/graycoreio/magento2-cors/commit/8753bd2))
* **all:** set up CI with Azure Pipelines ([#15](https://github.com/graycoreio/magento2-cors/issues/15)) ([f30b51f](https://github.com/graycoreio/magento2-cors/commit/f30b51f))
* **ci:** run integration tests in ci ([#21](https://github.com/graycoreio/magento2-cors/issues/21)) ([a79d7f7](https://github.com/graycoreio/magento2-cors/commit/a79d7f7))


### Features

* **cors:** add header provider for Allow-Credentials ([#27](https://github.com/graycoreio/magento2-cors/issues/27)) ([38bf597](https://github.com/graycoreio/magento2-cors/commit/38bf597))


### Tests

* **configuration:** added/updated unit tests for config files ([#19](https://github.com/graycoreio/magento2-cors/issues/19)) ([826b68e](https://github.com/graycoreio/magento2-cors/commit/826b68e))
* **integration:** updated integration tests to pass ([#23](https://github.com/graycoreio/magento2-cors/issues/23)) ([89736d7](https://github.com/graycoreio/magento2-cors/commit/89736d7))



## [1.2.0](https://github.com/graycoreio/magento2-cors/compare/v1.1.0...v1.2.0) (2020-01-20)


### Features

* **rest:** fixup rest api to handle options requests ([#13](https://github.com/graycoreio/magento2-cors/issues/13)) ([3520b9d](https://github.com/graycoreio/magento2-cors/commit/3520b9d))



## [1.1.0](https://github.com/graycoreio/magento2-cors/compare/v1.0.0...v1.1.0) (2020-01-17)


### Bug Fixes

* **graphql:** swap config key name ([#10](https://github.com/graycoreio/magento2-cors/issues/10)) ([2aed35c](https://github.com/graycoreio/magento2-cors/commit/2aed35c))


### Features

* **rest:** add CORS support for Magento 2 REST APIs ([#11](https://github.com/graycoreio/magento2-cors/issues/11)) ([2342976](https://github.com/graycoreio/magento2-cors/commit/2342976))
* **rest:** allow rest api and graphql apis to be configurable separately ([#12](https://github.com/graycoreio/magento2-cors/issues/12)) ([ff5813e](https://github.com/graycoreio/magento2-cors/commit/ff5813e))



## 1.0.0 (2019-07-23)


### Bug Fixes

* **configuration:** remove backtick in di.xml ([3a6549c](https://github.com/graycoreio/magento2-cors/commit/3a6549c))


### Features

* **cors:** initial package with configuration and validation for CORS headers on the GraphQL api ([493c6ad](https://github.com/graycoreio/magento2-cors/commit/493c6ad))
* **release:** add basic release process ([b09b62b](https://github.com/graycoreio/magento2-cors/commit/b09b62b))
* **security:** enforce security by default, no headers out of the box ([cb3291c](https://github.com/graycoreio/magento2-cors/commit/cb3291c))



## 1.0.0 (2019-07-23)


### Bug Fixes

* **configuration:** remove backtick in di.xml ([3a6549c](https://github.com/graycoreio/magento2-cors/commit/3a6549c))


### Features

* **cors:** initial package with configuration and validation for CORS headers on the GraphQL api ([493c6ad](https://github.com/graycoreio/magento2-cors/commit/493c6ad))
* **release:** add basic release process ([b09b62b](https://github.com/graycoreio/magento2-cors/commit/b09b62b))
* **security:** enforce security by default, no headers out of the box ([cb3291c](https://github.com/graycoreio/magento2-cors/commit/cb3291c))
