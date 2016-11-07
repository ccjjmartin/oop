#!/bin/bash

# On this project phpdoc should be installed by composer, if you wish to install
# it globally follow the instructions below.

# Update projects documentation
# If you haven't installed phpdoc locally run these two commands:
# pear channel-discover pear.phpdoc.org
# pear install phpdoc/phpdocumentor
# - or -
# download: http:// phpdoc.org/ phpDocumentor.phar
# run: php phpDocumentor.phar -h
# After phpdoc is installed you can run:

phpdoc -d ./ -t ./docs --title='OOP' --template=clean
