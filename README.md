# Flipper Module
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
