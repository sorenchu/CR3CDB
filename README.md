CR3C
====

A Symfony project created on September 21, 2016, 8:05 pm.

For solving all the dependencies needed for deploying this project, it is recommended to install composer.
In a Linux system, that can be done with steps inclued in [1]. Once we have composer installed in our current project,
it is required to launch:

$ /path/where/composer/launcher/is/composer.phar update

When this process finishes, we will need to create our database

$ php app/console doctrine:database:create

After that, when the database has been already created, we need to update our tables

$ php app/console doctrine:schema:update --force

That's it! We have our project ready for being started. We'll do with

$ php app/console server:run

and opening a browser with the address and port that we have specified (typically, localhost and 8000 [2]), we will see our 
project running.

TIME TO HACK!

[1] https://getcomposer.org/download/
[2] https://localhost:8000

