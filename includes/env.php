<?php
class Environment {
    private static $variables = [];
    
    public static function load($path) {
        if (!file_exists($path)) {
            throw new Exception(".env file not found: $path");
        }
        
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            $parts = explode('=', $line, 2);
            if (count($parts) == 2) {
                $name = trim($parts[0]);
                $value = trim($parts[1]);
                self::$variables[$name] = $value;
                putenv("$name=$value");
                $_ENV[$name] = $value;
            }
        }
    }
    
    public static function get($key, $default = null) {
        return self::$variables[$key] ?? $default;
    }
}

Environment::load(__DIR__ . '/../.env');
