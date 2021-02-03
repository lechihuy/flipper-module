# Flipper Module

<p align="center">
<a href="https://github.com/lechihuy/flipper-module/actions"><img src="https://github.com/lechihuy/flipper-module/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/flipper/module"><img src="https://img.shields.io/packagist/dt/flipper/module" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/flipper/module"><img src="https://img.shields.io/packagist/v/flipper/module" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/flipper/module"><img src="https://img.shields.io/packagist/l/flipper/module" alt="License"></a>
</p>

Building Laravel framework with Microservice architecture.

## Install

In root `composer.json` file of project, append the code bellow:
```
"repositories": [
    {
        "type": "path",
        "url": "./modules/*"
    }
]
```

Then run `composer dump-autoload` command.

### Creata a new module
To create a new module in project, we can use this Artisan command:
```
php artisan module:create [module-name]
```

Then we fill necessary information to create it. 

### Delete the specified module
We can use Artisan command bellow to delete any specified module:
```
php artisan module:delete [module-name]
```
