#!/bin/bash

echo "Are you sure you want to install phing globally?";
echo "You can use composer instead, hit ctrl+c to cancel.";
read answer;

wget https://phar.phpunit.de/phpunit.phar
chmod +x phpunit.phar
sudo mv phpunit.phar /usr/local/bin/phpunit
phpunit --version
