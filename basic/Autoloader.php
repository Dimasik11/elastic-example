<?php

/**
 * Class Autoloader
 */
class Autoloader
{
    /**
     * Инициализация простенького автолоадера
     */
    public static function autoload()
    {
        spl_autoload_register(function ($class) {
            $info = explode('\\', $class);
            $path = '';
            $className = array_pop($info);
            foreach ($info as $dir) {
                $path .= $dir  . '/';
            }
            $path = $path . $className . '.php';

            if (file_exists($path)) {
                require_once $path;
            }
        });
    }

}