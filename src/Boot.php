<?php

namespace App;

use Doctrine\Common\Cache\Cache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;


class Boot
{
    private static Configuration $config;
    public static array $paths = [__DIR__ . '/Entity'];
    private static bool $isDevMode = true;
    private static ?string $proxyDir = null;
    private static ?Cache $cache = null;
    private static bool $useSimpleAnnotationReader = false;
    private static array $dbParams = [
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => 'root',
        'dbname'   => 'test',
    ];

    public static EntityManager $entityManager;

    /**
     * @throws ORMException
     */
    public static function init()
    {
        self::$config = Setup::createAnnotationMetadataConfiguration(self::$paths, self::$isDevMode, self::$proxyDir, self::$cache, self::$useSimpleAnnotationReader);
        self::$entityManager = EntityManager::create(self::$dbParams, self::$config);
    }
}
