#!/bin/bash

echo "Have you installed the geckodriver manually?";
echo "There is a composer project but it has the wrong binary for macs ..."
echo "You will need to manually download it at:"
echo "https://github.com/mozilla/geckodriver/releases"
echo "Hit ctrl+c to cancel and install the driver manually.";
echo "You will need to install it to <this project>/vendor/bin/geckodriver"
read answer;

java -Dwebdriver.gecko.driver=./vendor/bin/geckodriver -jar ./vendor/se/selenium-server-standalone/bin/selenium-server-standalone.jar
