# Developer Documentation

## Contributing
Please read the [contributing guidelines here](https://github.com/graycoreio/magento2-cors/blob/develop/CONTRIBUTING.md).

## Building the Project
This project is intended to be installed as a composer dependency for a Magento application, so if you're working with it as a custom module, you'll need to install your own Magento instance and then this project as a dependency.

### Prerequisites
* [Git](https://git-scm.com/)
* PHP 7.2+
* [Magento](https://github.com/magento/magento2)
    * Check the versions supported by the project in the README
* [Composer](https://getcomposer.org/)


## Testing
Tests help us ensure code quality and backwards compatibility across various Magento and PHP versions. Please make sure you write clear and concise tests BEFORE you write your code, otherwise there will be no way to verify that your tests achieve the intended goals.

### Unit Tests
You can run the unit tests by defined by the `composer` script.

```bash 
composer run-script unit-test
```

## Integration Tests
These must be run from the Magento application's `dev/tests/integration` directory.

```bash
../../../vendor/bin/phpunit --testsuite "Graycore_Magento2Cors"
```