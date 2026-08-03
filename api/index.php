<?php

// Prepare writable storage directory in /tmp for Vercel serverless environment
$storageDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy SQLite database file to /tmp for writable SQLite access on Vercel
$tmpDbPath = '/tmp/database.sqlite';
$sourceDbPath = __DIR__ . '/../database/database.sqlite';

if (!file_exists($tmpDbPath)) {
    if (file_exists($sourceDbPath)) {
        copy($sourceDbPath, $tmpDbPath);
    } else {
        touch($tmpDbPath);
    }
}

putenv("DB_DATABASE={$tmpDbPath}");
$_ENV['DB_DATABASE'] = $tmpDbPath;
$_SERVER['DB_DATABASE'] = $tmpDbPath;

// Forward request to Laravel's public/index.php
require __DIR__ . '/../public/index.php';
