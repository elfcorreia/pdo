<?php

namespace pdo;

function build_dsn() {
    switch (DB_DRIVER) {
        case 'pgsql':
            $p = defined('DB_PORT') ? DB_PORT : 5432;
            return 'pgsql:host='.DB_HOST.";port={$p};dbname=".DB_NAME.';';
        default:
            trigger_error('DB_DRIVER '.DB_DRIVER.'not found!');
    }
}

function build_pdo() {
    return new \PDO(build_dsn(), DB_USER, DB_PASSWORD, [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    ]);
}

function get_pdo() {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = build_pdo();
    }
    return $pdo;
}