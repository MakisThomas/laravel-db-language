# Laravel DB Language 

This package gives you an easy way to generate automatically all language fields on database, using Laravel 5 command.  If you have on database fields like `body_en` and you want to create new like `body_it` you can use this package to create it.


### Installing

First, pull in the package through Composer.

```
composer require makth/laravel-db-language
```

And then include the service provider within `config/app.php`.

```
Makth\DbLanguage\DbLanguageServiceProvider::class
```




### Usage 

```
php artisan language:add German
```
It finds all `*_en` fields on database an generates matches `*_de`.

The default language is English, but you can change it using option `--default`. For example:
```
php artisan language:add German --default="French"
```
These will create on database all matches `*_de` from `*_fr`.


### Authors

* **Makis Thomas** 


### License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

