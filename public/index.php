<?php declare(strict_types=1);

require_once '../vendor/autoload.php';

use App\Core\Redirect;
use App\Core\Renderer;
use App\Core\Router;
use App\Core\TwigView;
use Dotenv\Dotenv;

session_start();

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

$routes = require_once '../routes.php';
$response = Router::response($routes);
$renderer = new Renderer('../app/Views');

if ($response instanceof TwigView) {
    echo $renderer->render($response);
}

if ($response instanceof Redirect) {
    header('location: ' . $response->path());
    exit;
}