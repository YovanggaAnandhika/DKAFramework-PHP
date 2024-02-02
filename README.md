# DKA FRAMEWORK
### powerfull framework for integration

## Status

![GitHub last commit](https://img.shields.io/github/last-commit/DKAResearchCenter/DKAPHPFramework)
![GitHub contributors](https://img.shields.io/github/contributors/DKAResearchCenter/DKAPHPFramework)
![GitHub pull requests](https://img.shields.io/github/issues-pr/DKAResearchCenter/DKAPHPFramework)
![GitHub issues](https://img.shields.io/github/issues/DKAResearchCenter/DKAPHPFramework)
![GitHub repo size](https://img.shields.io/github/repo-size/DKAResearchCenter/DKAPHPFramework)


## Benefit

**Flexible:** System opens and closes the function of loading the required modules because the framework module is
unloading Install it.

**Fast:** Optimizes Servers with Low RAM, and the Fastest Combination of Frameworks, and Compression Technologies The
good one.

## Feature

* **Structured.** Easily Comprehensible and Neat Code and Callable Like a Modulation Pack.
* **No Interface Blocking.** Can Run Without Interfering With Other Functions.
* **Complete Documentation.** Complete and Included Documentation and Sample Code.
* **Free from Error.** There is an Error Detection so that Finding Errors Can be Easily Done.
* **Without Installing WebServer.** Using the main JS language that is suitable in terms of data efficiency.
* **More Other Features.** 🐈

## Installing DKA PHP Framework Module

## step 1 - Installing Composer : 

### In Linux
```shell
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
```
### in Windows

1a. Download Composer Installer .exe in this link
[Download](https://getcomposer.org/Composer-Setup.exe)<br/>
1b. Select PHP Interpreter Location Ex:C://xampp/php or C://program files/php


## step 2 - Installing Packagist Library :

``` composer require yovanggaanandhika/dkaframework:<version> ```

## step 3 - Example Code : 

```injectablephp
   <?php
   
   require_once "./../vendor/autoload.php";

   //add namespace of modules
   use yovanggaanandhika\dkaframework\Module\Database\MariaDB\MariaDB;
   use \yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD;
   use yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD\Read;
   use yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD\Delete;

    /** @var array $db_config DB Configuration to Access Database */
    $db_config = array(
        'host' => "localhost",
        'user' => "developer",
        'password' => "Cyberhack2010",
        'database' => "test"
    );
    /** @var MariaDB $MariaDB call classess MariaDB */
    $MariaDB = new MariaDB($db_config);
    /** @var CRUD\CRUD $CRUD Add Crud For Create | Read | Update | delete */
    $CRUD = $MariaDB->CRUD();
    /** @var Read\Options $Options Read Options Of Data */
    $Options = new Read\Options();
    $Options
        ->jsonFormat(true) // Show Result to Array Formated PHP Or JSON String
        ->addSearch(array(
            "id" => 2
        ));
    /** @var $Read variable for Result Read */
    $Read = $CRUD->Read("test", $Options);
    //##############
    /** Example Format Show Data */
    header('Content-Type: application/json');
    /** Show Result */
    print_r($Read);
```

Read More About [Installation Guide](https://github.com/YovanggaAnandhika/Server/blob/v3/INSTALL.md) On the Website
Us For More Information.



### For Development donation
It cannot be denied that development requires time and energy as well as the operational side. If You Would Be Kind To Buy Me A Cup Of Coffee. Use the following donation payments.

![alt text](https://github.com/YovanggaAnandhika/DKAFramework-Typescript/blob/production/docs/assets/images/qris-yovangga.jpg?raw=true)

More Details About Donation Options :
[DONATION](https://github.com/DKAResearchCenter/DKAPHPFramework/blob/master/README.md)

Read About : </b>[LICENCE](https://github.com/DKAResearchCenter/DKAPHPFramework/blob/master/README.md)

## Team

| [@yovangga](https://github.com/yovanggaanandhika)                                                                       | [@DKAResearchCenter](https://github.com/DKAResearchCenter)                                                    |
|-------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------|
| <img align="center" src="https://avatars.githubusercontent.com/yovanggaanandhika?s=100&v=1" width="100" height="100" /> | <img align="center" src="https://avatars.githubusercontent.com/DKAResearchCenter?s" width="100" height="100"> |
| Full Stack Development                                                                                                  | DKA Research Center                                                                                           |

## Kredit

Thanks To [DKA Research Center](https://github.com/YovanggaAnandhika) To Donate a Package Name!
