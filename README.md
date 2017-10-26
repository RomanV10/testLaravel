run composer require "roman/testLaravel @dev"

To "providers" in /config/app.php add
    Collective\Html\HtmlServiceProvider::class,
    TestLaravel\Items\ItemsServiceProvider::class,

To "aliases" in "/config/app.php" add
    'Form' => Collective\Html\FormFacade::class,
    'Html' => Collective\Html\HtmlFacade::class,

run "composer dumpautoload"
run "php artisan vendor:publish"
run "php artisan migrate"

