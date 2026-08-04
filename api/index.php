<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Artisan;

// Prepare writable storage directory in /tmp for Vercel serverless environment
$storageDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache',
    '/tmp/storage/logs',
    '/tmp/storage/app/public',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy SQLite database file to /tmp for writable SQLite access on Vercel
$tmpDbPath = '/tmp/database.sqlite';
$sourceDbPath = __DIR__ . '/../database/database.sqlite';
$sourceDbPathAlt = __DIR__ . '/../furniture_store';

if (!file_exists($tmpDbPath) || filesize($tmpDbPath) === 0) {
    if (file_exists($sourceDbPath) && filesize($sourceDbPath) > 0) {
        copy($sourceDbPath, $tmpDbPath);
    } elseif (file_exists($sourceDbPathAlt) && filesize($sourceDbPathAlt) > 0) {
        copy($sourceDbPathAlt, $tmpDbPath);
    } else {
        touch($tmpDbPath);
    }
}

putenv("DB_DATABASE={$tmpDbPath}");
$_ENV['DB_DATABASE'] = $tmpDbPath;
$_SERVER['DB_DATABASE'] = $tmpDbPath;

// Auto-migrate & seed if articles table doesn't exist in /tmp/database.sqlite
try {
    $pdo = new PDO("sqlite:" . $tmpDbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='articles'")->fetchAll();
    if (empty($tables)) {
        require_once __DIR__ . '/../vendor/autoload.php';
        $app = require __DIR__ . '/../bootstrap/app.php';
        $kernel = $app->make(Kernel::class);
        $kernel->bootstrap();

        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
    }
} catch (\Throwable $e) {
    // Continue gracefully if check or auto-migration fails
}

// Forward request to Laravel's public/index.php
require __DIR__ . '/../public/index.php';
