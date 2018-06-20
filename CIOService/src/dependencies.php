<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    $logger->pushHandler(new Monolog\Handler\RotatingFileHandler($settings['path'], $settings['maxFiles'], $settings['level']));
    return $logger;
};

$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($settings);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

$container['LoginController'] = function ($c) {
    return new \App\Controller\LoginController($c->get('logger'), $c->get('db'));
};

$container['AboutController'] = function ($c) {
    return new \App\Controller\AboutController($c->get('logger'), $c->get('db'));
};

$container['AttachFileController'] = function ($c) {
    return new \App\Controller\AttachFileController($c->get('logger'), $c->get('db'));
};

$container['PalaceController'] = function ($c) {
    return new \App\Controller\PalaceController($c->get('logger'), $c->get('db'));
};

$container['AuthorityController'] = function ($c) {
    return new \App\Controller\AuthorityController($c->get('logger'), $c->get('db'));
};

$container['PolicyController'] = function ($c) {
    return new \App\Controller\PolicyController($c->get('logger'), $c->get('db'));
};

$container['ProjectController'] = function ($c) {
    return new \App\Controller\ProjectController($c->get('logger'), $c->get('db'));
};

$container['DocsController'] = function ($c) {
    return new \App\Controller\DocsController($c->get('logger'), $c->get('db'));
};

$container['ContactController'] = function ($c) {
    return new \App\Controller\ContactController($c->get('logger'), $c->get('db'));
};
