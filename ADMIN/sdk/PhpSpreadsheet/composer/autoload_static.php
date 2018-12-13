<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb181a72af59ad45c50110bce951a682a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'PhpOffice\\PhpSpreadsheet\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'PhpOffice\\PhpSpreadsheet\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpspreadsheet/src/PhpSpreadsheet',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb181a72af59ad45c50110bce951a682a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb181a72af59ad45c50110bce951a682a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}