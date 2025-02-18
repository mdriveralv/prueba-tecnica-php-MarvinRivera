<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src'],
    isDevMode: true
);

// Parámetros de Conexión
$connectionParams = [
    'dbname' => 'testdb',
    'user' => 'test',
    'password' => 'PasSw0rd',
    'host' => 'db',
    'driver' => 'pdo_mysql'
];

// Configuración conexión a base de datos
$connection = DriverManager::getConnection($connectionParams);

$entityManager = new EntityManager($connection, $config);
return $entityManager;
