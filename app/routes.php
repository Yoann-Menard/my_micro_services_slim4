<?php
declare(strict_types=1);

use App\Application\Actions\User\AddUserAction;
use App\Application\Actions\User\GetUserAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\LoginUserAction;
use App\Application\Actions\User\DeleteUserAction;
use App\Application\Actions\User\UpdateUserAction;
use App\Application\Actions\Message\AddMessageAction;
use App\Application\Actions\Message\GetMessageAction;
use App\Application\Actions\Message\ListMessagesAction;
use App\Application\Actions\Message\DeleteMessageAction;
use App\Application\Actions\Message\UpdateMessageAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('home page');
        return $response;
    });

    $app->post('/register', AddUserAction::class);

    $app->post('/login', LoginUserAction::class);

    $app->group('/message', function (Group $group) {
        $group->get('s', ListMessagesAction::class);
        $group->post('', AddMessageAction::class);
        $group->get('/{id}', GetMessageAction::class);
        $group->put('/{id}', UpdateMessageAction::class);
        $group->delete('/{id}', DeleteMessageAction::class);
    })->add(new \Tuupola\Middleware\JwtAuthentication([
        "secret" => $_SERVER['SECRET_KEY']
    ]));

    $app->group('/user', function (Group $group) {
        $group->get('s', ListUsersAction::class);
        $group->post('', AddUserAction::class);
        $group->get('/{id}', GetUserAction::class);
        $group->put('/{id}', UpdateUserAction::class);
        $group->delete('/{id}', DeleteUserAction::class);
    })->add(new \Tuupola\Middleware\JwtAuthentication([
        "secret" => $_SERVER['SECRET_KEY']
    ]));
};
