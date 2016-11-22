# OOP
Object Orientated Programming

This contains both my notes from:

PHP Objects, Patterns, and Practice
By Matt Zandstra

And a custom built exercise to test many areas of knowledge mentioned in the
book.

## WIP:
This project is a work in progress.  It is currently pending:

1. Addition of autoloading functionality.
2. Transfer to twig file templates.
3. Addition of PHP Unit tests.
4. Addition of additional commonly used patterns.
5. Addition of UML files.
6. Build caching functionality for external api calls.
7. Remove procedural twitter example.

## Future plans:
These items will probably never get time to materialize:

1. Build a router and other items mentioned in overview diagram.

## Testing Locally (on a mac):
I am currently using XAMPP to test this since it only needs apache and php to
run.  To set this up on XAMPP I went into the httpd-vhost.conf file found at
/Applications/XAMPP/etc/extra and added configuration that matched where I
installed the repository.  I also edited the httpd.conf file found at
/Applications/XAMPP/etc to uncomment the include referencing the vhosts file.

Then start the Apache server.

NOTE: An example httpd-vhosts.conf file can be found in the examples directory.
Edit this file at least twice to match your repository install location.

## Testing Twitter locally:
You will need to register for a TwitterAPIKey.

Go to: https://apps.twitter.com/

Create a new app.  Make sure you visit the keys and access tokens tab and create
a consumer key and then an access token.

Copy the twitter/example.settings.php file to twitter/settings.php and drop your
private credentials into the file (do not commit these but keep them in a safe
place).

## Scripts:
If you wish to run any scripts run them from the project root directory using
the syntax bash scripts/{script}

## Exercise #1:

Your mission should you choose to accept it, will be to go undercover in
Conglomerate Inc., this monstrosity loves to gather data, all kinds of data,
data from everywhere.  The big boss "El Jefe" has instructed everyone at the
company to find ways to add more content to the website.  In order to work your
way up the corporate ladder you must design a system that is:

1. Object orientated in php
2. Easily extensible in the future
3. Able to accept the following file types:
  1. Text files (csv)
  2. Yaml files (yml)
  3. For the zealous enough ... twitter feeds.
4. You will need to provide basic coverage using php unit testing.

As always, should you or any of your team be caught or killed, the Secretary
will disavow any knowledge of your actions. This recording will self-destruct in
five seconds.

Good luck!
