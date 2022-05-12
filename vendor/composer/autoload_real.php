<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit36e0fc8a7d06259f5c7bb178cf84ebb5
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit36e0fc8a7d06259f5c7bb178cf84ebb5', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit36e0fc8a7d06259f5c7bb178cf84ebb5', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit36e0fc8a7d06259f5c7bb178cf84ebb5::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInit36e0fc8a7d06259f5c7bb178cf84ebb5::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire36e0fc8a7d06259f5c7bb178cf84ebb5($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire36e0fc8a7d06259f5c7bb178cf84ebb5($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
