set -e

echo Running Integration Tests

echo "Installing additonal PHP Dependencies"
sudo apt-get install php7.2-intl

echo "Cloning Magento 2 Repo"
git clone --depth 1 https://github.com/magento/magento2.git ../magento2

echo 'Creating database'
mysql -u root -proot < ./ci/scripts/create-database.sql

echo 'copying ci/phpunit.xml'
cp ci/phpunit.xml ../magento2/dev/tests/integration/phpunit.xml

echo 'copying ci/install-mysql-config.php'
cp ci/install-config-mysql.php ../magento2/dev/tests/integration/etc/install-config-mysql.php

echo "Creating Module Directory"
mkdir -p ../magento2/app/code/Graycore/Cors 
cp -r * ../magento2/app/code/Graycore/Cors

echo "Change directory into magento2"
cd ../magento2

echo "Installing Composer Dependencies..."
composer install --no-interaction --prefer-dist