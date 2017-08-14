# Laravel DB Language 

This package gives you an easy way to generate automatically all language fields on database, using Laravel command.  If you have on database fields like `body_en` and you want to create new like `body_it` you can use this package to create it.


### Installing

A step by step series of examples that tell you have to get a development env running

Say what the step will be

```
Give the example
```

And repeat

```
until finished
```

End with an example of getting some data out of the system or using it for a little demo


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

