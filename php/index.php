<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';

$app = AppFactory::create();

$app->get('/alunni', "AlunniController:index");

$app->get('/alunni/{id:\d+}', "AlunniController:show");

$app->post('/alunni', "AlunniController:create");

$app->put('/alunni/{id:\d+}', "AlunniController:update");

$app->delete('/alunni/{id:\d+}', "AlunniController:delete");

$app->get('/alunni/search/{txt}', "AlunniController:filter");


$app->get('/alunni/order/deshending/{cs:[NnCc]}', "AlunniController:deshendingOrder");

$app->get('/alunni/order/ascending/{cs:[NnCc]}', "AlunniController:ashendingOrder");



$app->run();
