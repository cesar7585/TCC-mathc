

<?php

ini_set('log_errors', 1); 
ini_set('error_log', __DIR__ . '/logs/error.log');
ini_set('display_errors', 1);
error_reporting(E_ALL); 

require_once __DIR__ . '/routes/Router.php';

function logDebug($message) {
    $logMessage = "[" . date('Y-m-d H:m:s') . "] DEBUG: " . $message . "\n";
    file_put_contents(__DIR__ . '/logs/debug.log', $logMessage, FILE_APPEND);
}

function logDbError($errorMessage) {
    $log = "[" . date('Y-m-d H:m:s') . "] Erro no banco de dados: " . $errorMessage . "\n";
    file_put_contents(__DIR__ . '/logs/db_errors.log', $log, FILE_APPEND);
}

function logAuth($status, $email) {
    $log = "[" . date('Y-m-d H:m:s') . "] LOGIN $status - Usuário: $email - IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    file_put_contents(__DIR__ . '/logs/auth.log', $log, FILE_APPEND);
}

function logAccess() {
    $log = "[" . date('Y-m-d H:m:s') . "] IP: " . $_SERVER['REMOTE_ADDR'] . " - URL: " . $_SERVER['REQUEST_URI'] . " - METHOD: " . $_SERVER['REQUEST_METHOD'] . "\n";
    file_put_contents(__DIR__ . '/logs/access.log', $log, FILE_APPEND);
}

logAccess();

$requestUri = $_SERVER['REQUEST_URI'];

$router = new Router;
$router->run($requestUri);