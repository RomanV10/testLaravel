```bash
Copy from css/test.css to  "/css" "test.css"** 
```
**To "composer.json" add**
```json
"repositories": [
        {
            "type": "package",
            "package": {
                "name": "roman/testLaravel",
                "version": "dev",
                "source": {
                    "url": "git@github.com:RomanV10/testLaravel.git",
                    "type": "git",
                    "reference": "master"
                },
                "require": {
                    "php": ">=7.0",
                    "laravelcollective/html": "^5.2.0"
                },
                "autoload": {
                    "psr-4": {
                        "TestLaravel\\Items\\": "src/"
                    }
                }
            }
        }
    ]
```

**Run**
```bash
composer require "roman/testLaravel @dev"
 ```
**To "providers" in /config/app.php add**
```php
Collective\Html\HtmlServiceProvider::class,
TestLaravel\Items\ItemsServiceProvider::class,
```

**To "aliases" in "/config/app.php" add**
```php
'Form' => Collective\Html\FormFacade::class,
'Html' => Collective\Html\HtmlFacade::class,
```
**Then run**
```bash
composer dumpautoload
php artisan vendor:publish
php artisan migrate
```

