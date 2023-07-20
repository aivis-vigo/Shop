<?php declare(strict_types=1);

use App\Core\Renderer;
use App\Core\Router;
use Dotenv\Dotenv;

require_once '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

$routes = require_once '../routes.php';
$response = Router::response($routes);
$renderer = new Renderer('../app/Views');

echo $renderer->render($response);