<?php
// autoload.php
spl_autoload_register(function ($class) {
    $dirs = [
        'app/controller/',
        'app/model/',
        'app/middleware/',
        'app/services/',
        'app/migration/',
        'app/router/'
    ];

    foreach ($dirs as $dir) {
        $file = __DIR__ . '/' . $dir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
