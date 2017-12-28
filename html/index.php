<?php

use App\Kernel;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';

// The check is to ensure we don't use .env in production
if (!isset($_SERVER['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__ . '/../.env');
}

if ($_SERVER['APP_DEBUG'] ?? ('prod' !== ($_SERVER['APP_ENV'] ?? 'dev'))) {
    umask(0000);

    $valid_passwords = array("admin" => "Password");
    $valid_users = array_keys($valid_passwords);

    if (isset($_SERVER['PHP_AUTH_USER'])) {
        $auth_user = $_SERVER['PHP_AUTH_USER'];
    } else {
        $auth_user = '';
    }
    if (isset($_SERVER['PHP_AUTH_PW'])) {
        $auth_pass = $_SERVER['PHP_AUTH_PW'];
    } else {
        $auth_pass = '';
    }

    $auth_validated = (in_array($auth_user, $valid_users)) && ($auth_pass == $valid_passwords[$auth_user]);

    if (!$auth_validated) {
        header('WWW-Authenticate: Basic realm="Dev Environment"');
        header('HTTP/1.0 401 Unauthorized');
        die("Not authorized");
    }
    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies),
        Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts(explode(',', $trustedHosts));
}

$kernel = new Kernel($_SERVER['APP_ENV'] ?? 'dev',
    $_SERVER['APP_DEBUG'] ?? ('prod' !== ($_SERVER['APP_ENV'] ?? 'dev')));
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
