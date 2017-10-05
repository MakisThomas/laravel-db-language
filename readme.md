# Laravel DB Language

This package gives you an easy way to generate automatically all language fields on database, using Laravel 5 command.  If you have on database fields like `body_en` and you want to create new like `body_it` you can use this package to create it.


## Installing

First, pull in the package through Composer.

``` 
composer require makth/laravel-db-language 
```

or

```php
"require":{
    "makth/laravel-db-language": "2.0"
}
```

Next, open `config/app.php`, and include service provider.

```php
'providers' => [
    Makth\DbLanguage\DbLanguageServiceProvider::class,
];
```

And, for convenience, add a facade alias to the same file at the bottom:

```php
'aliases' => [
    'Lang' => Makth\DbLanguage\Facade\Lang::class,
];
```



## Usage 

### Add a language
```
php artisan language:add German
```

### Remove a language
```
php artisan language:remove German
```

#### Default language
You can set your default language using option `--default`. For example:
```
php artisan language:add German --default="English"
```
If you want to have more than one languages, you set your main (already installed) language as default, and you add the other languages. 


### Config
You can publish config file `lang.php`, and set your default language there.
```
php artisan vendor:publish --tag=config
```


### Language Field
You can have form fields with multiple languages.

#### Step 1
Export css files to public folder.
```
php artisan vendor:publish --tag=flags
```

#### Step 2
Add in your blade file, on head tag:
```
@include('lang::style')
```
And at the bottom of the body:
```
@include('lang::script')
```

And now you can get the form field with all installed languages like this:
```blade
{{ Lang::fields(
    'table_name',
    'field_name', 
    ['first_language_value', 'second_language_value'], 
    null,
    [ 'placeholder' => 'Name', 'required' => 'required']
    ) 
}}
```
- `table_name` : the name of the db table.
- `field_name` : the name of table field, without language extension.
- the third parameter is an array with languages values.
- the fourth parameter used to set manual the default language.
- the fifth parameter is an array with extra attributes for the fields.

For form fields used twitter bootstrap, and for the flags [this](https://github.com/lipis/flag-icon-css) package. 


## Authors

* **Makis Thomas**


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

