<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2de9d4901295399b63e31a31c7ec637c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2de9d4901295399b63e31a31c7ec637c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2de9d4901295399b63e31a31c7ec637c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2de9d4901295399b63e31a31c7ec637c::$classMap;

        }, null, ClassLoader::class);
    }
}