<?php
class Kernel
{


    function __construct()
    {
        define('ROOT_DIR', __DIR__);
        $this->loadEnv('.env');
    }

    public function absoluteRequire($path)
    {
        require_once(ROOT_DIR . $path);
    }

    public function e404()
    {
        http_response_code(404);
        require_once ROOT_DIR . '/views/global/404.php';
        die();
    }

    function loadEnv($file)
    {
        $file = ROOT_DIR . "/$file";
        if (!file_exists($file)) {
            return false;
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);


            if (!array_key_exists($name, $_SERVER)) {
                $_SERVER[$name] = $value;
            }
            if (!array_key_exists($name, $_ENV)) {
                $_ENV[$name] = $value;
            }
        }
    }
}

$Kernel = new Kernel();
