<?php
// Routes

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//$app->get('/user/{id}', 'UserController:getUser');
$app->post('/login/', 'LoginController:authenticate');

$app->post('/abouts/', 'AboutController:getAbout');
$app->post('/abouts/update/', 'AboutController:updateAbout');

$app->delete('/attach/delete/{id}', 'AttachFileController:removeAttachFile');

$app->post('/palaces/', 'PalaceController:getPalace');
$app->post('/palaces/current/', 'PalaceController:getPalaceCurrent');
$app->post('/palaces/update/', 'PalaceController:updatePalace');
$app->delete('/palaces/delete/{id}', 'PalaceController:removePicture');

$app->post('/authorities/', 'AuthorityController:getAuthority');
$app->post('/authorities/update/', 'AuthorityController:updateAuthority');

$app->post('/policies/', 'PolicyController:getPolicy');
$app->post('/policies/update/', 'PolicyController:updatePolicy');

$app->post('/projects/', 'ProjectController:getProject');
$app->post('/projects/view/', 'ProjectController:getProjectView');
$app->post('/projects/update/', 'ProjectController:updateProject');

$app->post('/contacts/', 'ContactController:getContact');
$app->post('/contacts/update/', 'ContactController:updateContact');


// Default action
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
