<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita9f185dbdca27e32ab00a15b515c3cf3
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita9f185dbdca27e32ab00a15b515c3cf3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita9f185dbdca27e32ab00a15b515c3cf3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita9f185dbdca27e32ab00a15b515c3cf3::$classMap;

        }, null, ClassLoader::class);
    }
}
