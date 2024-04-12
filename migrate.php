<?php

function execute($method)
{
    $dir = new DirectoryIterator('api/migrations');

    foreach ($dir as $fileinfo) {
        if (!$fileinfo->isDot() && $fileinfo->getExtension() === 'php') {
            include_once $fileinfo->getPathname();
        }
    }

    $classes = get_declared_classes();

    foreach ($classes as $class) {
        if (method_exists($class, $method)) {
            call_user_func([$class, $method]);
        }
    }
}

function migrate()
{
    execute('up');
}

function rollback()
{
    execute('down');
}

if (!empty($argv[1]) && $argv[1] === 'rollback') {
    rollback();
} else {
    migrate();
}
