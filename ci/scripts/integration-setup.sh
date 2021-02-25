set -e

echo Running Integration Tests

echo "Cloning Magento 2 Repo"
git clone --branch $magentoTag  --depth 1 https://github.com/magento/magento2.git ../magento2

echo "Enabling MySQL on the Agent"
sudo systemctl start mysql.service

echo 'Creating database'
mysql -u root -proot < ./ci/scripts/create-database.sql

echo 'copying ci/phpunit.xml'
cp ci/phpunit.xml ../magento2/dev/tests/integration/phpunit.xml

if [ "$magentoTag" = "2.3" ]
then
  echo 'copying ci/install-mysql-config-2.3.php'
  cp ci/install-config-mysql-2.3.php ../magento2/dev/tests/integration/etc/install-config-mysql.php
elif [ "$magentoTag" = "2.4" ]
then
  echo 'copying ci/install-mysql-config-2.4.php'
  cp ci/install-config-mysql-2.4.php ../magento2/dev/tests/integration/etc/install-config-mysql.php
else
  echo "Unsupported Magento Version, exiting."
  exit 0
fi

echo "Creating Module Directory"
mkdir -p ../magento2/app/code/Graycore/Cors 
cp -r * ../magento2/app/code/Graycore/Cors

echo "Change directory into magento2"
cd ../magento2

echo "Installing Composer Dependencies..."
composer install --no-interaction --prefer-dist