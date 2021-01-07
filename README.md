# LBRYexplorer
A [LBRY](https://lbry.com) block explorer based on Laravel.

 > ### :information_source:  Note
 > This project is on early stages of development, it is currently hosted [here](https://spallina.dev). Pease expect bugs and missing pages.

#### Dependencies:
* [PHP 7.4.11]
* [LBRYcrd v0.12.4.1](https://github.com/lbryio/lbrycrd/releases/tag/v0.12.4.1)
* [LBRY Chainquery v1.8.1](https://github.com/lbryio/chainquery/releases/tag/v1.8.1)
* [Laravel v8.16.1](https://laravel.com/docs/8.x)

### Install

* Clone repo and navigate to /src folder
* Install dependencies with `composer update`
* Create .env file from .env.example and edit variables according to your environment
* Launch server with `php artisan serve`

#### Models:
Current model schema reflect chainquery [schema](https://github.com/lbryio/chainquery/blob/master/db/chainquery_schema.sql)

![Model Schema](https://spee.ch/@SK3LA:3/chainqueryschema2.svg)
