# Testing Adjacency List (Category) with Symfony 3 
Hello, i made this example for my studies. Fell free to use and modify to your needed. I'm still working on it, so there is a possibility can find some bugs or not run properly.
Beyond the Adjacency List, i had testing:

 - Routing, Methods and Templates by [SensioFrameworkExtraBundle/annotations](https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html)
 - Twig Extensions
 - SPL RecursiveIteratorIterator


![Printscreen of the Home](https://github.com/rafaelcavalcanti/symfony3-bootstrap-adjacency-list-crud/blob/master/doc/screenshot001.jpg)

## Packages used
Some of the packages used in this project (composer show -i):

| Package                       | Version |
| ----------------------------- |:-------:| 
| Symfony                       | 3.3.5   |
| Doctrine ORM                  | 2.5.6   |
| Stof Doctrine Extension       | 1.2.2   |
| Bootstrap                     | 3.3.7   |
| Sensio Framework Extra Bundle | 3.0.26  |


## Installation
I suppose that you already have a composer installed in your system and some [XAMPP](https://www.apachefriends.org), [MAMP](https://www.mamp.info/en/), LAMP activated either. If you have some experience T.I. consider using [Docker](https://www.docker.com/). 
Next step would be cloning this project following the commands bellow:

    $ git clone https://github.com/rafaelcavalcanti/symfony3-bootstrap-adjacency-list-crud.git
    $ cd symfony3-bootstrap-adjacency-list-crud
    $ compose install

After that, install the assetics:

    $ php bin/console assetic:dump

Refresh translation file:


    $ php bin/console translation:extract en --config=app --output-format=xliff

## Usage
On you browser:

    http://localhost/app_dev.php

## Frequently Asked Questions

 - How to make setup a translation to my language?

Find your **language-code** through [ISO-639-1](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes), in my case [pt_BR](https://en.wikipedia.org/wiki/IETF_language_tag).
 
    $ php bin/console translation:extract **[language-code]** --config=app --output-format=xliff

 - Why its so slow to render the **/app_dev.php**?

Try to put (or set) in your **php.ini** this params:

    realpath_cache_size = 4096k
    realpath_cache_ttl = 7200

... and follow this [recommendations](https://symfony.com/doc/current/performance.html).

## Known Bugs

 1. ~~There is no translation of views yet.~~ (en)
 2. The dropdown with listing of parent is not organized by name.


## To Do

 1. Possibility to change the order of the menu.
 2. Making a option to choose what language the client wants.

## License