<?php

return [
    'intramitra' => [
        'driver'        => 'oracle',
        'tns'            => '(DESCRIPTION= (ADDRESS=(PROTOCOL=tcp)(HOST=12.123.28.2)(PORT=1521)) (CONNECT_DATA=(SID=ORCLMJ)))',
        'host'          => env('DB_HOST_1', ''),
        'port'          => env('DB_PORT_1', '1521'),
        'database'      => env('DB_DATABASE_1', ''),
        'username'      => env('DB_USERNAME_1', ''),
        'password'      => env('DB_PASSWORD_1', ''),
        'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
    'mitra' => [
        'driver'        => 'oracle',
        'tns'            => '(DESCRIPTION= (ADDRESS=(PROTOCOL=tcp)(HOST=12.123.28.2)(PORT=1521)) (CONNECT_DATA=(SID=ORCLMJ)))',
        'host'          => env('DB_HOST_2', ''),
        'port'          => env('DB_PORT_2', '1521'),
        'database'      => env('DB_DATABASE_2', ''),
        'username'      => env('DB_USERNAME_2', ''),
        'password'      => env('DB_PASSWORD_2', ''),
        'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
    'sehati' => [
        'driver'        => 'oracle',
        'tns'           => '(DESCRIPTION= (ADDRESS=(PROTOCOL=tcp)(HOST=12.123.28.2)(PORT=1521)) (CONNECT_DATA=(SID=ORCLMJ)))',
        'host'          => env('DB_HOST_3', ''),
        'port'          => env('DB_PORT_3', '1521'),
        'database'      => env('DB_DATABASE_3', ''),
        'username'      => env('DB_USERNAME_3', ''),
        'password'      => env('DB_PASSWORD_3', ''),
        'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
    'jaya' => [
        'driver'        => 'oracle',
        'tns'           => '(DESCRIPTION= (ADDRESS=(PROTOCOL=tcp)(HOST=12.123.28.2)(PORT=1521)) (CONNECT_DATA=(SID=ORCLMJ)))',
        'host'          => env('DB_HOST_4', ''),
        'port'          => env('DB_PORT_4', '1521'),
        'database'      => env('DB_DATABASE_4', ''),
        'username'      => env('DB_USERNAME_4', ''),
        'password'      => env('DB_PASSWORD_4', ''),
        'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
    'maju' => [
        'driver'        => 'oracle',
        'tns'           => '(DESCRIPTION= (ADDRESS=(PROTOCOL=tcp)(HOST=12.123.28.2)(PORT=1521)) (CONNECT_DATA=(SID=ORCLMJ)))',
        'host'          => env('DB_HOST_5', ''),
        'port'          => env('DB_PORT_5', '1521'),
        'database'      => env('DB_DATABASE_5', ''),
        'username'      => env('DB_USERNAME_5', ''),
        'password'      => env('DB_PASSWORD_5', ''),
        'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
];
