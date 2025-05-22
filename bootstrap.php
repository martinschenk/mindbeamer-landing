<?php

// Start session for language selection
session_start();

// Create required directories if they don't exist
$appDir = __DIR__ . '/app';
$langDir = $appDir . '/lang';
$enDir = $langDir . '/en';
$deDir = $langDir . '/de';

$directories = [$appDir, $langDir, $enDir, $deDir];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Include helper functions
require_once __DIR__ . '/app/helpers.php';

// Set default locale based on browser language
if (!isset($_SESSION['locale'])) {
    $browserLang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : '';
    
    // If browser language is German, set locale to German, otherwise use English as default
    if ($browserLang === 'de') {
        $_SESSION['locale'] = 'de';
    } else {
        $_SESSION['locale'] = 'en'; // English is the default/fallback
    }
}

// Handle explicit language switching
if (isset($_GET['locale'])) {
    setAppLocale($_GET['locale']);
}

// Set page language attribute for HTML tag
$htmlLang = getCurrentLocale();
