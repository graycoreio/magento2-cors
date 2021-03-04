# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

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
