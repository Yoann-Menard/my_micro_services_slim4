<?php
declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'db' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' => 'slimApi',
                'username' => 'root',
                'password' => 'password',
                'collation' => 'utf8_general_ci',
                'charset' => 'utf8',
                'prefix' => ''
                ],
                'jwt_authentication' => [
                'secret' => $_ENV['JWT_SECRET'],
                'algorithm' => 'HS256',
                'secure' => false, // only for localhost for prod and test env set true
        '        error' => static function ($response, $arguments) {
                    $data['status'] = 401;
                    $data['error'] = 'Unauthorized/'. $arguments['message'];
                    return $response
                        ->withHeader('Content-Type', 'application/json;charset=utf-8')
                        ->getBody()->write(json_encode(
                        $data,
                        JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                    ));
                }
            ],        
        ]);
    }
]);
};
